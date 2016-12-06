<?php

Route::group(['middleware' => 'web', 'prefix' => 'production', 'namespace' => 'Modules\Production\Http\Controllers'], function()
{
    Route::resource('buyers', 'BuyersController');
    Route::get('/buyer/fetchBuyersList', ['uses' => 'BuyersController@fetchBuyersList', 'as' => 'Buyers List']);
    Route::get('/buyers/fetchBuyerDetails/{id}', ['uses' => 'BuyersController@fetchBuyerDetails', 'as' => 'Buyer Details']);
    Route::get('/buyer/update/{field}/{id}/{value}', ['uses' => 'BuyersController@updateField', 'as' => 'Update Information']);
    Route::delete('/buyer/{buyer}/{action}', ['uses' => 'BuyersController@destroy', 'as' => 'Remove Buyer Details']);
    Route::get('/styles', ['uses' => 'NewController@index', 'as' => 'Production']);


    /*Route::get('/', ['uses' => 'ProductionController@index', 'as' => 'Production']);
    .. Route::get('/buyers', ['uses' => 'BuyersController@index', 'as' => 'Buyers']);
   .. Route::post('/buyers/add', ['uses' => 'BuyersController@addBuyer', 'as' => 'Buyers']);
    Route::get('/buyers/all', ['uses' => 'BuyersController@getAll', 'as' => 'Buyers']);
   ... Route::get('/buyer/show/{id}', ['uses' => 'BuyersController@show', 'as' => 'Buyer Details']);*/
});