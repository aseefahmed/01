<?php

Route::group(['middleware' => 'web', 'prefix' => 'buying', 'namespace' => 'Modules\Buying\Http\Controllers'], function()
{
	Route::get('/', 'BuyingController@index');
});