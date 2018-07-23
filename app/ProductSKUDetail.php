<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class ProductSKUDetail extends Model
{
    public $table='product_sku_details';
    public $timestamps = false;

    public function productSku(){
        return $this->belongsTo(ProductSKU::class, 'product_sku_id', 'id');
    }
}
