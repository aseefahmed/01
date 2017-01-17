<?php

Route::group(['middleware' => 'web', 'prefix' => 'buying', 'namespace' => 'Modules\Buying\Http\Controllers'], function()
{
<<<<<<< HEAD
	Route::get('/', 'BuyingController@index');
	Route::post('orders/store', ['uses' => 'BuyingController@storeOrders', 'as' => 'Orders']);
	Route::get('/order/fetchOrdersList/{user_id}/{emp_role}', ['uses' => 'BuyingController@fetchOrdersList', 'as' => 'Orders List']);
    Route::get('/orders/fetchOrderDetails/{id}', ['uses' => 'OrdersController@fetchOrderDetails', 'as' => 'Order Details']);
=======
    Route::get('/', 'BuyingController@index');
    Route::post('orders/store', ['uses' => 'BuyingController@storeOrders', 'as' => 'Orders']);
    Route::get('/order/fetchOrdersList/{user_id}/{emp_role}', ['uses' => 'BuyingController@fetchOrdersList', 'as' => 'Orders List']);
    Route::get('/order/fetchOrdersList/{user_id}/{emp_role}', ['uses' => 'BuyingController@fetchOrdersList', 'as' => 'Orders List']);
    Route::get('/order/fetchOrderDetails/{id}', ['uses' => 'BuyingController@fetchOrderDetails', 'as' => 'Order Details']);
    Route::get('/order/update/{user_id}/{field}/{id}/{value}', ['uses' => 'BuyingController@updateField', 'as' => 'Update Information']);
	
>>>>>>> 65019209a329a1b0a30c02c017f94b77a69a8ecd
});