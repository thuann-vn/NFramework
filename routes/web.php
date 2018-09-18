<?php

Route::get('/', 'LandingPageController@index')->name('landing-page');

Route::get('/shop', 'ShopController@index')->name('shop.index');
Route::get('/product/{product}', 'ShopController@show')->name('shop.show');
Route::get('/category/{parent}/{category?}', 'ShopController@category')->name('shop.category');
Route::get('/department/{department}', 'ShopController@department')->name('shop.department');
Route::get('/brand/{brand}/{category?}', 'ShopController@brand')->name('shop.brand');
Route::get('/sale/{category?}', 'ShopController@sale')->name('shop.sale');

Route::get('/cart', 'CartController@index')->name('cart.index');
Route::post('/cart', 'CartController@store')->name('cart.store');
Route::patch('/cart/{product}', 'CartController@update')->name('cart.update');
Route::delete('/cart/{product}', 'CartController@destroy')->name('cart.destroy');
Route::post('/cart/switchToSaveForLater/{product}', 'CartController@switchToSaveForLater')->name('cart.switchToSaveForLater');

Route::get('/wish-list', 'SaveForLaterController@index')->name('saveForLater.index');
Route::get('/wish-list/add/{product}', 'SaveForLaterController@store')->name('saveForLater.store');
Route::delete('/wish-list/{product}', 'SaveForLaterController@destroy')->name('saveForLater.destroy');
Route::post('/wish-list/switchToCart/{product}', 'SaveForLaterController@switchToCart')->name('saveForLater.switchToCart');

Route::post('/coupon', 'CouponsController@store')->name('coupon.store');
Route::delete('/coupon', 'CouponsController@destroy')->name('coupon.destroy');

Route::get('/checkout', 'CheckoutController@index')->name('checkout.index')->middleware('auth');
Route::post('/checkout', 'CheckoutController@store')->name('checkout.store');

Route::get('/guestCheckout', 'CheckoutController@index')->name('guestCheckout.index');


Route::get('/thankyou', 'ConfirmationController@index')->name('confirmation.index');

Route::get('/travel-center', 'PostController@index')->name('travel_center.index');
Route::get('/travel-center/{post}', 'PostController@show')->name('travel_center.show');

Route::get('/page/{page}', 'pageController@show')->name('page.show');

//ACCOUNT ROUTES
Route::group(['prefix' => 'my-account'], function () {
    Route::get('/', 'AccountController@index')->name('my-account');
    Route::get('/edit-account', 'AccountController@edit')->name('edit-account');
    Route::post('/update-account', 'AccountController@update')->name('update-account');

    Route::get('/address-book', 'AccountController@addressBook')->name('my-address-book');
    Route::get('/address-book/add', 'AccountController@addressBookAdd')->name('add-address');
    Route::post('/address-book/store', 'AccountController@addressBookStore')->name('store-address');
    Route::get('/address-book/edit/{id}', 'AccountController@addressBookUpdate')->name('edit-address');
    Route::post('/address-book/update', 'AccountController@updateAddress')->name('update-address');
    Route::post('/address-book/delete', 'AccountController@deleteAddress')->name('delete-address');

    Route::get('/change-password', 'AccountController@changePassword')->name('change-password');
    Route::post('/update-password', 'AccountController@updatePassword')->name('update-password');

    Route::get('/orders', 'AccountController@myOrders')->name('my-orders');
});

//ADMIN ROUTES
Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();

    Route::post('product-property', ['uses' => 'Voyager\ProductPropertiesController@postProductProperty', 'as' => 'admin.postProductProperty']);
    Route::delete('delete-product-property/{id}', ['uses' => 'Voyager\ProductPropertiesController@deleteProductProperty', 'as' => 'admin.deleteProductProperty']);

    Route::post('post-variant', ['uses' => 'Voyager\ProductVariantsController@postProductAttribute', 'as' => 'admin.postProductAttribute']);
    Route::get('get-attribute-value/{attribute_name}', ['uses' => 'Voyager\ProductVariantsController@getAttributeValue', 'as' => 'admin.getAttributeValue']);
    Route::get('generate-product-variants/{id}', ['uses' => 'Voyager\ProductVariantsController@generateSkus', 'as' => 'admin.generateProductVariants']);
    Route::post('update-product-variant/{id}', ['uses' => 'Voyager\ProductVariantsController@updateSku', 'as' => 'admin.updateProductVariant']);
    Route::delete('delete-product-variant/{id}', ['uses' => 'Voyager\ProductVariantsController@deleteSku', 'as' => 'admin.deleteProductVariant']);

    Route::delete('delete-variant/{id}', ['uses' => 'Voyager\ProductVariantsController@deleteProductAttribute', 'as' => 'admin.deleteProductAttribute']);
    Route::delete('delete-variant-value/{id}', ['uses' => 'Voyager\ProductVariantsController@deleteProductAttributeValue', 'as' => 'admin.deleteProductAttributeValue']);

    Route::get('/link-with-messenger', 'Auth\LoginController@sendLinkFbMessengerRequest')->name('admin.linkWithMessenger');


});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/contact', 'HomeController@index')->name('contact');

Route::get('/search', 'ShopController@search')->name('search');

Route::get('/search-algolia', 'ShopController@searchAlgolia')->name('search-algolia');

Route::get('lang/{lang}', ['as'=>'lang.switch', 'uses'=>'LanguageController@changeLocale']);

Route::get('/webhook', 'WebhookController@getWebhook')->name('get-webhook');
Route::post('/webhook', 'WebhookController@postWebhook')->name('post-webhook');

Route::middleware('auth')->get('/link-fb-messenger', 'Auth\LoginController@linkFbMessenger')->name('link-fb-messenger');