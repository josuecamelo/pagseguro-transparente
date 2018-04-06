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

Route::get('/', ['as' => 'loja.index', 'uses' => 'LojaController@index']);
Route::get('carrinho', ['as' => 'loja.carrinho-compras', 'uses' => 'LojaController@carrinho']);


Route::get('cart', ['as'=>'cart', 'uses'=>'CartController@index']);
Route::get('cart/add/{id}', ['as'=>'cart.add', 'uses'=>'CartController@add']);
Route::get('cart/destroy/{id}', ['as'=>'cart.destroy', 'uses'=>'CartController@destroy']);


Route::group(['middleware' => 'auth'],function(){
    Route::get('checkout/placeOrder', ['as' => 'checkout.place', 'uses' => 'CheckoutController@place']);
    Route::get('account/orders', ['as' => 'account.orders', 'uses' => 'AccountController@orders']);
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
