<?php

namespace App;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;
use TCG\Voyager\Traits\HasRelationships;
use TCG\Voyager\Traits\Resizable;
use TCG\Voyager\Traits\Translatable;

class Product extends Model
{
    use SearchableTrait,
        Searchable,
        Translatable,
        Resizable,
        HasRelationships;

    const NO_CHANGED_FLG = 0;
    const ATTRIBUTE_CHANGED_FLG = 1;
    const ATTRIBUTE_VALUE_CHANGED_FLG = 2;

    protected $translatable = ['name', 'description', 'details', 'slug', 'meta_description', 'meta_keywords'];

    /**
     * Searchable rules.
     *
     * @var array
     */
    protected $searchable = [
        /**
         * Columns and their priority in search results.
         * Columns with higher values are more important.
         * Columns with equal values have equal importance.
         *
         * @var array
         */
        'columns' => [
            'products.name' => 10,
            'products.details' => 5,
            'products.description' => 2,
        ],
    ];

    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }

    public function brand()
    {
        return $this->belongsTo('App\Brand', 'brand_id', 'id');
    }


    public function presentPrice()
    {
        return money_format('$%i', $this->price);
    }

    public function regularPrice()
    {
        if(!empty($this->regular_price)){
            return money_format('$%i', $this->regular_price);
        }
        return 0;
    }

    public function scopeMightAlsoLike($query)
    {
        return $query->inRandomOrder()->take(4);
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $array = $this->toArray();

        $extraFields = [
            'categories' => $this->categories->pluck('name')->toArray(),
        ];

        return array_merge($array, $extraFields);
    }
}
