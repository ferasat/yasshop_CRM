<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/home', 'DashboardController@index')->name('home');

Route::prefix('dashboard')->middleware('auth')->group( function () {
    Route::get('/','DashboardController@index')->name('dashboard');

/*
    Route::get('PostCotroller@postindex', '/post');
    Route::get('/post/new','PostCotroller@newpost');
    Route::post('/post/new','PostCotroller@savepost');

    Route::get('/post/cat','CategoryController@index');
    Route::post('/post/cat','CategoryController@savecat');


    Route::get('/page','PageCotroller@pageindex');
    Route::get('/page/new','PageCotroller@newpage');
    Route::post('/page/new','PageCotroller@savepage');
    Route::get('/page/edit/','PageCotroller@editpage');
    Route::get('/page/update/{id}','PageCotroller@updatepage');
    Route::get('/page/del/{id}','PageCotroller@deletepage');
*/
    /// محصولات
    Route::get('/product','ProductController@productindex');
    Route::get('/product/new','ProductController@creatProduct');
    Route::post('/product/new','ProductController@newProduct');
    Route::get('/product/edit', 'ProductController@editProduct');
    Route::post('/product/adddell','ProductController@adddell');
    Route::get('/product_crm', 'WarehousingController@productInCrm')->name('productInCrm');
    /// دستبندی محصولات
    Route::get('/product/cat','CategoryController@index');
    Route::post('/product/cat','CategoryController@savecat');
    Route::post('/product/cat','CategoryController@savecat');
    // سفارشات
    Route::get('/orders/','CartController@indexOrder')->name('orders'); // سفارشات
    Route::get('/orders/new','CartController@newOrder')->name('newOrder'); // سفارش جدید
    Route::get('/orders/posted','CartController@posted')->name('posted'); // ارسال شده
    Route::get('/orders/notShipped','CartController@notShipped')->name('notShipped');
    Route::get('/orders/deficit','CartController@deficit')->name('deficit'); /// کالا هایی که کم داریم
    Route::get('/orders/outStock','CartController@outStock')->name('outStock');  // کالاهایی که نداریم
    Route::get('/orders/forBoxing','CartController@forBoxing')->name('forBoxing'); // در محله بستبندی
    Route::get('/orders/forBoxing/saveNote','CartController@saveNote')->name('saveNote'); // در محله بستبندی ذخیره یاداشت
    Route::get('/orders/forBoxing/toKasri','CartController@toKasri'); //سفارشاتی که به کسری دارد
    Route::get('/orders/forBoxing/toPost','CartController@toPost'); // آماده برای ارسال
    Route::get('/orders/forBoxing/errorInfo','CartController@errorInfo'); // اطلاعات مشتری مشکل دارد
    Route::get('/orders/forBoxing/checkForPost','CartController@checkForPost')->name('checkForPost'); //چک کردن برای  آماده  ارسال
    Route::get('/orders/forBoxing/apply','CartController@apply'); // تایید و ارسال شد
    Route::post('/orders/new','CartController@createCart'); // ساخت سبد سفارش
    Route::get('/orders/cart/update','CartController@updateCart');
    Route::get('/orders/cart/deleteFromCart','CartController@deleteFromCart');
    Route::get('/orders/cart/{id}','CartController@showCart');
    Route::get('/orders/cart/{id}/add','CartController@addToCart');
    Route::post('/orders/cart/saveProductToCart','CartController@saveProductToCart')->name('saveProductToCart');
    Route::get('/orders/cart/saveInfoCart/{id}','CartController@saveInfoCart');
    Route::post('/orders/cart/saveInfoCart/{id}','CartController@saveFinalInfoCart');
    Route::get('/orders/cart/invoice/{id}','CartController@invoice');

    Route::get('/search/','SearchController@index');
    Route::get('/search/s/','SearchController@search');
    Route::get('/search/ajax/','SearchController@ajaxSearch');


    /* --------  انبارداری  -------------*/
    Route::get('/warehousing/','WarehousingController@index')->name('warehousing');
    Route::get('/warehousing/price-controller','WarehousingController@priceControl')->name('priceControl');
    Route::get('/warehousing/savePricesToStore','WarehousingController@savePricesToStore');

    /*--------- ترمیم دیتابیس --------------*/
    Route::prefix('/db')->middleware('auth')->group( function () {
        Route::get('/','HomeController@db');
        Route::get('/fixDB','HomeController@fixDB');
    });
});

Route::group(['prefix'=>'/cat'], function(){
    Route::get('/{id}','CategoryController@showcat');
});


Route::group(['prefix'=>'/support'], function(){
    Route::get('/','SupportController@indexSupport');
    Route::get('/new','SupportController@newSupport');
    Route::post('/new','SupportController@saveSupport');
    Route::get('/update/{id}','SupportController@updateSupport');
});
