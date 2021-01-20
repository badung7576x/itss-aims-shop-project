<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'middleware'=>'web', 'namespace' => '\Modules\Admin\Http\Controllers'], function() {
    Route::get('/', 'Auth\AdminLoginController@showLoginForm');
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.post-login');

    Route::group(['middleware' => 'auth.admin'], function () {
        Route::get('/dashboard', 'AdminController@index')->name('admin.dashboard');
        Route::get('/product-list', 'ProductController@index')->name('admin.product.list');
        Route::get('/product-create', 'ProductController@showCreateForm')->name('admin.product.create');
        Route::post('/product-create', 'ProductController@create')->name('admin.product.post-create');
        Route::get('/render-property-form', 'ProductController@renderPropertyForm')->name('admin.product.renderform');
        Route::get('/product-edit/{id}', 'ProductController@showEditForm')->name('admin.product.edit');
        Route::get('/product-promotion/{id}', 'ProductController@showChoosePromotion')->name('admin.product.promotion');
        Route::post('/product-promotion/update', 'ProductController@updateChoosePromotion')->name('admin.product.promotionUpdate');
        Route::post('/product-promotion/add-product-to-promotion', 'ProductController@addProductToPromotion')->name('admin.product.addToPromotion');
        Route::post('/product-edit', 'ProductController@edit')->name('admin.product.post-edit');
        Route::post('/product-delete', 'ProductController@delete')->name('admin.product.post-delete');
        Route::get('/product-detail/{id}', 'ProductController@detail')->name('admin.product.detail');
        Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
        Route::get('/histories', 'ActionHistoryController@index')->name('admin.histories');
        Route::resource('promotion', 'PromotionController');
        Route::get('/product-promotion/promotion-detail/{id}/delete', 'PromotionController@destroyPromotionDetail')->name('admin.product.promotion-detail.delete');
    });

});
