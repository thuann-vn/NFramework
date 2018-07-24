<?php

namespace App\Http\Controllers\Voyager;

use App\Brand;
use App\Product;
use App\Category;
use App\CategoryProduct;
use App\ProductAttribute;
use App\ProductAttributeDetail;
use App\ProductProperty;
use App\ProductSKU;
use App\ProductSKUDetail;
use App\Property;
use App\Attribute;
use App\AttributeValue;
use Illuminate\Http\Request;
use Mockery\Exception;
use TCG\Voyager\Facades\Voyager;
use Illuminate\Support\Facades\DB;
use TCG\Voyager\Events\BreadDataAdded;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Events\BreadDataDeleted;
use TCG\Voyager\Events\BreadDataUpdated;
use TCG\Voyager\Events\BreadImagesDeleted;
use TCG\Voyager\Database\Schema\SchemaManager;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;
use TCG\Voyager\Http\Controllers\Traits\BreadRelationshipParser;
use TCG\Voyager\Http\Controllers\ContentTypes\Image as ContentImage;

class ProductsController extends VoyagerBaseController
{
    use BreadRelationshipParser;

    //***************************************
    //               ____
    //              |  _ \
    //              | |_) |
    //              |  _ <
    //              | |_) |
    //              |____/
    //
    //      Browse our Data Type (B)READ
    //
    //****************************************

    public function index(Request $request)
    {
        // GET THE SLUG, ex. 'posts', 'pages', etc.
        $slug = $this->getSlug($request);

        // GET THE DataType based on the slug
        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        $this->authorize('browse', app($dataType->model_name));

        $getter = $dataType->server_side ? 'paginate' : 'get';

        $search = (object)['value' => $request->get('s'), 'key' => $request->get('key'), 'filter' => $request->get('filter')];
        $searchable = $dataType->server_side ? array_keys(SchemaManager::describeTable(app($dataType->model_name)->getTable())->toArray()) : '';
        $orderBy = $request->get('order_by');
        $sortOrder = $request->get('sort_order', null);

        // Next Get or Paginate the actual content from the MODEL that corresponds to the slug DataType
        if (strlen($dataType->model_name) != 0) {
            $model = app($dataType->model_name);
            $query = $model::select('*');

            $relationships = $this->getRelationships($dataType);

            // If a column has a relationship associated with it, we do not want to show that field
            $this->removeRelationshipField($dataType, 'browse');

            if ($search->value && $search->key && $search->filter) {
                $search_filter = ($search->filter == 'equals') ? '=' : 'LIKE';
                $search_value = ($search->filter == 'equals') ? $search->value : '%' . $search->value . '%';
                $query->where($search->key, $search_filter, $search_value);
            }

            if ($orderBy && in_array($orderBy, $dataType->fields())) {
                $querySortOrder = (!empty($sortOrder)) ? $sortOrder : 'DESC';
                $dataTypeContent = call_user_func([
                    $query->with($relationships)->orderBy($orderBy, $querySortOrder),
                    $getter,
                ]);
            } elseif ($model->timestamps) {
                $dataTypeContent = call_user_func([$query->latest($model::CREATED_AT), $getter]);
            } else {
                $dataTypeContent = call_user_func([$query->with($relationships)->orderBy($model->getKeyName(), 'DESC'), $getter]);
            }

            // Replace relationships' keys for labels and create READ links if a slug is provided.
            $dataTypeContent = $this->resolveRelations($dataTypeContent, $dataType);
        } else {
            // If Model doesn't exist, get data from table name
            $dataTypeContent = call_user_func([DB::table($dataType->name), $getter]);
            $model = false;
        }

        // Check if BREAD is Translatable
        if (($isModelTranslatable = is_bread_translatable($model))) {
            $dataTypeContent->load('translations');
        }

        // Check if server side pagination is enabled
        $isServerSide = isset($dataType->server_side) && $dataType->server_side;

        $view = 'voyager::bread.browse';

        if (view()->exists("voyager::$slug.browse")) {
            $view = "voyager::$slug.browse";
        }

        return Voyager::view($view, compact(
            'dataType',
            'dataTypeContent',
            'isModelTranslatable',
            'search',
            'orderBy',
            'sortOrder',
            'searchable',
            'isServerSide'
        ));
    }

    //***************************************
    //                ______
    //               |  ____|
    //               | |__
    //               |  __|
    //               | |____
    //               |______|
    //
    //  Edit an item of our Data Type BR(E)AD
    //
    //****************************************

    public function edit(Request $request, $id)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Compatibility with Model binding.
        $id = $id instanceof Model ? $id->{$id->getKeyName()} : $id;

        $relationships = $this->getRelationships($dataType);

        $dataTypeContent = (strlen($dataType->model_name) != 0)
            ? app($dataType->model_name)->with($relationships)->findOrFail($id)
            : DB::table($dataType->name)->where('id', $id)->first(); // If Model doest exist, get data from table name

        foreach ($dataType->editRows as $key => $row) {
            $details = json_decode($row->details);
            $dataType->editRows[$key]['col_width'] = isset($details->width) ? $details->width : 100;
        }

        // If a column has a relationship associated with it, we do not want to show that field
        $this->removeRelationshipField($dataType, 'edit');

        // Check permission
        $this->authorize('edit', $dataTypeContent);

        // Check if BREAD is Translatable
        $isModelTranslatable = is_bread_translatable($dataTypeContent);

        $view = 'voyager::bread.edit-add';

        if (view()->exists("voyager::$slug.edit-add")) {
            $view = "voyager::$slug.edit-add";
        }

        $allCategories = Category::whereNull('parent_id')->get();
        $allBrands = Brand::all();

        $product = Product::find($id);
        $categoriesForProduct = $product->categories()->get();

        $active_tab = 'attributes';

        $propertyNames = Property::distinct(['name'])->where('group', 'Property')->get(['name']);
        $productProperties = ProductProperty::where('product_id', $id)->whereHas('property', function ($query) {
            return $query->where('group', 'Property');
        })->get();

        $attributeNames = Attribute::distinct(['name'])->get();
        $productAttributes = ProductAttribute::where('product_id', $id)->get();
        $productSKUs = ProductSKU::where('product_id', $id)->orderBy('id')->get();

        return Voyager::view($view, compact('dataType', 'dataTypeContent', 'isModelTranslatable', 'allCategories', 'allBrands', 'categoriesForProduct', 'active_tab', 'propertyNames', 'productProperties', 'attributeNames', 'productAttributes', 'productSKUs'));
    }

    // POST BR(E)AD
    public function update(Request $request, $id)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Compatibility with Model binding.
        $id = $id instanceof Model ? $id->{$id->getKeyName()} : $id;

        $data = call_user_func([$dataType->model_name, 'findOrFail'], $id);

        // Check permission
        $this->authorize('edit', $data);

        // Validate fields with ajax
        $val = $this->validateBread($request->all(), $dataType->editRows);

        if ($val->fails()) {
            return response()->json(['errors' => $val->messages()]);
        }

        if (!$request->ajax()) {
            $requestNew = $request;
            $requestNew['price'] = $request->price;

            $this->insertUpdateData($requestNew, $slug, $dataType->editRows, $data);

            event(new BreadDataUpdated($dataType, $data));

            CategoryProduct::where('product_id', $id)->delete();

            // Re-insert if there's at least one category checked
            $this->updateProductCategories($request, $id);

            return redirect()
                ->route("voyager.{$dataType->slug}.index")
                ->with([
                    'message' => __('voyager.generic.successfully_updated') . " {$dataType->display_name_singular}",
                    'alert-type' => 'success',
                ]);
        }
    }

    //***************************************
    //
    //                   /\
    //                  /  \
    //                 / /\ \
    //                / ____ \
    //               /_/    \_\
    //
    //
    // Add a new item of our Data Type BRE(A)D
    //
    //****************************************

    public function create(Request $request)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        $this->authorize('add', app($dataType->model_name));

        $dataTypeContent = (strlen($dataType->model_name) != 0)
            ? new $dataType->model_name()
            : false;

        foreach ($dataType->addRows as $key => $row) {
            $details = json_decode($row->details);
            $dataType->addRows[$key]['col_width'] = isset($details->width) ? $details->width : 100;
        }

        // If a column has a relationship associated with it, we do not want to show that field
        $this->removeRelationshipField($dataType, 'add');

        // Check if BREAD is Translatable
        $isModelTranslatable = is_bread_translatable($dataTypeContent);

        $view = 'voyager::bread.edit-add';

        if (view()->exists("voyager::$slug.edit-add")) {
            $view = "voyager::$slug.edit-add";
        }

        $allCategories = Category::all();
        $categoriesForProduct = collect([]);
        $active_tab = 'detail';
        $allBrands = Brand::all();

        return Voyager::view($view, compact('dataType', 'dataTypeContent', 'isModelTranslatable', 'allCategories', 'allBrands', 'categoriesForProduct', 'active_tab'));
    }

    /**
     * POST BRE(A)D - Store data.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        $this->authorize('add', app($dataType->model_name));

        // Validate fields with ajax
        $val = $this->validateBread($request->all(), $dataType->addRows);

        if ($val->fails()) {
            return response()->json(['errors' => $val->messages()]);
        }

        if (!$request->ajax()) {
            $requestNew = $request;
            $requestNew['price'] = $request->price;

            $data = $this->insertUpdateData($requestNew, $slug, $dataType->addRows, new $dataType->model_name());

            event(new BreadDataAdded($dataType, $data));

            $this->updateProductCategories($request, $data->id);

            return redirect()
                ->route("voyager.{$dataType->slug}.index")
                ->with([
                    'message' => __('voyager.generic.successfully_added_new') . " {$dataType->display_name_singular}",
                    'alert-type' => 'success',
                ]);
        }
    }

    protected function updateProductCategories(Request $request, $id)
    {
        if ($request->category) {
            foreach ($request->category as $category) {
                CategoryProduct::create([
                    'product_id' => $id,
                    'category_id' => $category,
                ]);
            }
        }
    }

    public function postProductProperty(Request $request)
    {
        $name = trim($request->input('name'));
        $value = trim($request->input('value'));
        $product = trim($request->input('product_id'));
        $group = 'Property';

        //Get property
        $property = Property::where('name', $name)->first();
        if (empty($property)) {
            $property = new Property;
            $property->name = $name;
            $property->group = $group;
            $property->save();
        }

        //Check if have existed property
        $productProperty = ProductProperty::where('product_id', $product)->where('property_id', $property->id)->first();
        if (empty($productProperty)) {
            $productProperty = new ProductProperty;
            $productProperty->product_id = $product;
            $productProperty->property_id = $property->id;
            $productProperty->value = $value;
            $productProperty->save();
        }

        return redirect()
            ->route("voyager.products.edit", ['id' => $product, 'active_tab' => 'properties'])
            ->with([
                'message' => __('voyager.generic.successfully_updated'),
                'alert-type' => 'success',
                'active_tab' => 'properties'
            ]);
    }


    public function getAttributeValue($attribute_name){
        $values = AttributeValue::whereHas('attribute', function ($query) use ($attribute_name){
            return $query->where('name', $attribute_name);
        })->get();
        return response()->json($values);
    }

    public function postProductAttribute(Request $request)
    {
        $name = trim($request->input('name'));
        $values = $request->input('value');
        $product_id = trim($request->input('product_id'));

        //Get property
        $attribute = Attribute::where('name', $name)->first();
        if (empty($attribute)) {
            $attribute = new Attribute;
            $attribute->name = $name;
            $attribute->save();
        }

        //Insert to productAttribute
        $productAttribute = ProductAttribute::where('product_id', $product_id)->where('attribute_id', $attribute->id)->first();
        if (empty($productAttribute)) {
            $productAttribute = new ProductAttribute();
            $productAttribute->product_id = $product_id;
            $productAttribute->attribute_id = $attribute->id;
            $productAttribute->save();
        }

        //Check if have existed property
        foreach ($values as $value) {
            $attributeValue = AttributeValue::where('attribute_id', $attribute->id)->where('value', $value)->first();
            if (empty($attributeValue)) {
                $attributeValue = new AttributeValue;
                $attributeValue->attribute_id = $attribute->id;
                $attributeValue->value = $value;
                $attributeValue->save();
            }

            //Insert new
            $productAttributeDetailExisted = ProductAttributeDetail::where('product_attribute_id', $productAttribute->id)->where('attribute_value_id', $attributeValue->id)->count();
            if($productAttributeDetailExisted == 0){
                $productAttributeDetail = new ProductAttributeDetail;
                $productAttributeDetail->product_attribute_id = $productAttribute->id;
                $productAttributeDetail->attribute_value_id = $attributeValue->id;
                $productAttributeDetail->save();
            }
        }

        //Update product flag
        $product = Product::where('id', $product_id)->first();
        $product->variant_alert_flg = 1;
        $product->save();

        return redirect()
            ->route("voyager.products.edit", ['id' => $product_id, 'active_tab' => 'properties'])
            ->with([
                'message' => __('voyager.generic.successfully_updated'),
                'alert-type' => 'success',
                'active_tab' => 'properties'
            ]);
    }

    public function deleteProductAttribute(Request $request, $id){
        $product_id =$request->input('product_id');

        //Delete
        ProductAttribute::findOrFail($id)->delete();

        //Update product flag
        $product = Product::where('id', $product_id)->first();
        $product->variant_alert_flg = 1;
        $product->save();

        return redirect()
            ->route("voyager.products.edit", ['id' => $product_id, 'active_tab' => 'properties'])
            ->with([
                'message' => __('voyager.generic.successfully_deleted'),
                'alert-type' => 'success',
                'active_tab' => 'properties'
            ]);
    }

    public function deleteProductAttributeValue(Request $request, $id){
        $product_id =$request->input('product_id');

        ProductAttributeDetail::findOrFail($id)->delete();

        //Update product flag
        $product = Product::where('id', $product_id)->first();
        $product->variant_alert_flg = 1;
        $product->save();

        return redirect()
            ->route("voyager.products.edit", ['id' => $product_id, 'active_tab' => 'properties'])
            ->with([
                'message' => __('voyager.generic.successfully_deleted'),
                'alert-type' => 'success',
                'active_tab' => 'properties'
            ]);

    }

    public function generateSkus($id){
        //Delete old sku first
        ProductSKUDetail::whereHas('productSku', function($query) use ($id){
            return $query->where('product_id', $id);
        })->delete();
        ProductSKU::where('product_id', $id)->delete();

        //Generate new
        $product = Product::find($id);
        $attributes =  ProductAttribute::where('product_id', $id)->get();

        $variants = [];
        foreach ($attributes as $index => $attribute){
            if($index == 0){
                foreach ($attribute->details as $detail){
                    $variants[] = [$detail->attributeValue];
                }
            }else{
                $variants = $this->combineVariants($variants, $attribute->details);
            }
        }

        foreach($variants as $variant){
            $name = '';
            foreach ($variant as $value){
                $name.= (!empty($name)?' + ' : '') . $value->value;
            }

            $productSKU = new ProductSKU;
            $productSKU->product_id = $id;
            $productSKU->name = $name;
            $productSKU->sku = '';
            $productSKU->price = $product->price;
            $productSKU->image = '';
            $productSKU->save();

            //Save detail
            foreach ($variant as $value){
                //Find first
                $existed = ProductSKUDetail::where('product_sku_id', $productSKU->id)->where('value_id', $value->id)->count() > 0;

                if(!$existed){
                    $skuDetail = new ProductSKUDetail;
                    $skuDetail->product_sku_id = $productSKU->id;
                    $skuDetail->value_id = $value->id;

                    $skuDetail->save();
                }
            }
        }
    }

    private function combineVariants($variants, $attributes){
        $result = [];
        foreach ($variants as $index => $variant){
            foreach ($attributes as $attribute){
                $resultItem = $variant;
                $resultItem[] = $attribute->attributeValue;
                $result[] = $resultItem;
            }
        }
        return $result;
    }

    public function updateSku(Request $request, $id){
        $productSKU= ProductSKU::findOrFail($id);
        $image = (new ContentImage($request, 'productskus', (object) array('field' => 'image'), (object) array()))->handle();
        if($image){
            $productSKU->image = $image;
        }
        $productSKU->name = $request->input('name');
        $productSKU->sku = $request->input('sku');
        $productSKU->price = $request->input('price');
        $productSKU->save();

        return redirect()
            ->route("voyager.products.edit", ['id' => $request->input('product_id'), 'active_tab' => 'properties'])
            ->with([
                'message' => __('voyager.generic.successfully_updated'),
                'alert-type' => 'success',
                'active_tab' => 'properties'
            ]);

    }
}
