<?php

Route::group(['middleware' => 'web', 'prefix' => 'buying', 'namespace' => 'Modules\Buying\Http\Controllers'], function()
{
	Route::get('/', 'BuyingController@index');
    Route::post('orders/store', ['uses' => 'BuyingController@storeOrders', 'as' => 'Orders']);
    Route::post('orders/uploadFiles/', ['uses' => 'BuyingController@uploadFiles', 'as' => 'File Upload']);
	Route::get('/order/fetchOrdersList/{user_id}/{emp_role}', ['uses' => 'BuyingController@fetchOrdersList', 'as' => 'Orders List']);
    Route::get('/orders/fetchOrderDetails/{id}', ['uses' => 'OrdersController@fetchOrderDetails', 'as' => 'Order Details']);
    Route::get('/', 'BuyingController@index');
    Route::post('orders/store', ['uses' => 'BuyingController@storeOrders', 'as' => 'Orders']);
    Route::get('/order/fetchOrdersList/{user_id}/{emp_role}', ['uses' => 'BuyingController@fetchOrdersList', 'as' => 'Orders List']);
    Route::get('/order/fetchOrdersList/{user_id}/{emp_role}', ['uses' => 'BuyingController@fetchOrdersList', 'as' => 'Orders List']);
    Route::get('/order/fetchOrderDetails/{id}', ['uses' => 'BuyingController@fetchOrderDetails', 'as' => 'Order Details']);
    Route::get('/order/update/{user_id}/{field}/{id}/{value}/{table_name}', ['uses' => 'BuyingController@updateField', 'as' => 'Update Information']);
    Route::post('/order/addColor', ['uses' => 'BuyingController@addColor', 'as' => 'Add Color']);
    Route::get('/orders/fetchOrdersStats', ['uses' => 'BuyingController@fetchOrdersStats', 'as' => 'Orders Stats']);

});