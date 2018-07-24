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

class ProductVariantsController extends VoyagerBaseController
{
    use BreadRelationshipParser;

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
                'active_tab' => 'attributes'
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
                'active_tab' => 'attributes'
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
                'active_tab' => 'attributes'
            ]);

    }

    public function generateSkus($id){
        $product = Product::where('id', $id)->first();

        if(!$product->variant_alert_flg){
            return redirect()
                ->route("voyager.products.edit", ['id' => $id, 'active_tab' => 'properties'])
                ->with([
                    'message' => __('voyager.generic.successfully_updated'),
                    'alert-type' => 'success',
                    'active_tab' => 'attributes'
                ]);
        }
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


        //Update product flag
        $product = Product::where('id', $id)->first();
        $product->variant_alert_flg = 1;
        $product->save();

        return redirect()
            ->route("voyager.products.edit", ['id' => $id, 'active_tab' => 'properties'])
            ->with([
                'message' => __('voyager.generic.successfully_updated'),
                'alert-type' => 'success',
                'active_tab' => 'attributes'
            ]);
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
                'active_tab' => 'attributes'
            ]);
    }
}
