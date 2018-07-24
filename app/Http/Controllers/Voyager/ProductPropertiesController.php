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

class ProductPropertiesController extends VoyagerBaseController
{
    use BreadRelationshipParser;

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
}
