<?php

Route::group(['middleware' => 'web', 'prefix' => 'buying', 'namespace' => 'Modules\Buying\Http\Controllers'], function()
{
	Route::get('/', 'BuyingController@index');
	Route::post('orders/store', ['uses' => 'BuyingController@storeOrders', 'as' => 'Orders']);
	Route::get('/order/fetchOrdersList/{user_id}/{emp_role}', ['uses' => 'BuyingController@fetchOrdersList', 'as' => 'Orders List']);
	
});