<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => '/{lang?}', 'where' => ['lang' => 'en|vi'], 'middleware' => ['api-lang']], function () {
    Route::get('/slider/get/{name}', ['uses' => 'Api\SliderApiController@getSlider', 'as' => 'api.getSlider'])->name('getSlider');
    Route::get('/menu/get/{name}', ['uses' => 'Api\MenuApiController@getMenu', 'as' => 'api.getMenu']);
    Route::get('/product/list', ['uses' => 'Api\ShopApiController@getProductList', 'as' => 'api.getProductList']);
    Route::get('/product/related/{id}', ['uses' => 'Api\ShopApiController@getRelatedProducts', 'as' => 'api.getRelatedProducts']);
    Route::get('/product/similar/{id}', ['uses' => 'Api\ShopApiController@getSimilarProducts', 'as' => 'api.getSimilarProducts']);
    Route::get('/category/list', ['uses' => 'Api\ShopApiController@getCategoryList', 'as' => 'api.getCategoryList']);
    Route::get('/brand/list', ['uses' => 'Api\ShopApiController@getBrandList', 'as' => 'api.getBrandList']);
});

Route::apiResources([
    'products' => 'Api\ProductController',
    'productCategories' => 'Api\ProductCategoryController',
    'productBrands' => 'Api\ProductBrandController',
    'images' => 'Api\ImageController',
]);