<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class ProductSKU extends Model
{
    public $table='product_skus';

    public function getPrice($productPrice){
        if(empty($this->price)){
            return $productPrice;
        }

        return $this->price;
    }

    public function details(){
        return $this->hasMany(ProductSKUDetail::class,'product_sku_id', 'id');
    }
}
