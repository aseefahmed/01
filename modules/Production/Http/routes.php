<?php

Route::group(['middleware' => 'web', 'prefix' => 'production', 'namespace' => 'Modules\Production\Http\Controllers'], function()
{
    Route::resource('buyers', 'BuyersController');
    Route::get('/buyer/fetchBuyersList', ['uses' => 'BuyersController@fetchBuyersList', 'as' => 'Buyers List']);
    Route::get('/buyers/fetchBuyerDetails/{id}', ['uses' => 'BuyersController@fetchBuyerDetails', 'as' => 'Buyer Details']);
    Route::get('/buyer/update/{field}/{id}/{value}', ['uses' => 'BuyersController@updateField', 'as' => 'Update Information']);
    Route::delete('/buyer/{buyer}/{action}', ['uses' => 'BuyersController@destroy', 'as' => 'Remove Buyer Details']);

    Route::resource('styles', 'StylesController');
    Route::get('/style/fetchStylesList', ['uses' => 'StylesController@fetchStylesList', 'as' => 'Styles List']);
    Route::get('/styles/fetchStyleDetails/{id}', ['uses' => 'StylesController@fetchStyleDetails', 'as' => 'Style Details']);
    Route::get('/style/update/{field}/{id}/{value}', ['uses' => 'StylesController@updateField', 'as' => 'Update Information']);
    Route::delete('/style/{style}/{action}', ['uses' => 'StylesController@destroy', 'as' => 'Remove Style Details']);

    Route::resource('suppliers', 'SuppliersController');
    Route::get('/supplier/fetchSuppliersList', ['uses' => 'SuppliersController@fetchSuppliersList', 'as' => 'Suppliers List']);
    Route::get('/suppliers/fetchSupplierDetails/{id}', ['uses' => 'SuppliersController@fetchSupplierDetails', 'as' => 'Supplier Details']);
    Route::get('/supplier/update/{field}/{id}/{value}', ['uses' => 'SuppliersController@updateField', 'as' => 'Update Information']);
    Route::delete('/supplier/{supplier}/{action}', ['uses' => 'SuppliersController@destroy', 'as' => 'Remove Supplier Details']);

    Route::resource('supplier-types', 'SupplierTypesController');
    Route::get('/supplier_type/fetchSupplierTypesList', ['uses' => 'SupplierTypesController@fetchSupplierTypesList', 'as' => 'SupplierTypes List']);
    Route::get('/supplier_types/fetchSupplierTypeDetails/{id}', ['uses' => 'SupplierTypesController@fetchSupplierTypeDetails', 'as' => 'SupplierType Details']);
    Route::get('/supplier_type/update/{field}/{id}/{value}', ['uses' => 'SupplierTypesController@updateField', 'as' => 'Update Information']);
    Route::delete('/supplier_type/{supplier_type}/{action}', ['uses' => 'SupplierTypesController@destroy', 'as' => 'Remove SupplierType Details']);

    Route::resource('orders', 'OrdersController');
    Route::get('/order/fetchOrdersList', ['uses' => 'OrdersController@fetchOrdersList', 'as' => 'Orders List']);
    Route::get('/orders/fetchOrderDetails/{id}', ['uses' => 'OrdersController@fetchOrderDetails', 'as' => 'Order Details']);
    Route::get('/order/update/{field}/{id}/{value}', ['uses' => 'OrdersController@updateField', 'as' => 'Update Information']);
    Route::delete('/order/{order}/{action}', ['uses' => 'OrdersController@destroy', 'as' => 'Remove Order Details']);

    Route::resource('orders', 'OrdersController');
    Route::get('/order/fetchOrdersList', ['uses' => 'OrdersController@fetchOrdersList', 'as' => 'Orders List']);
    Route::get('/orders/fetchOrderDetails/{id}', ['uses' => 'OrdersController@fetchOrderDetails', 'as' => 'Order Details']);
    Route::get('/order/update/{field}/{id}/{value}', ['uses' => 'OrdersController@updateField', 'as' => 'Update Information']);
    Route::delete('/order/{order}/{action}', ['uses' => 'OrdersController@destroy', 'as' => 'Remove Order Details']);
    Route::post('/order/addToRequisition', ['uses' => 'OrdersController@addToRequisition', 'as' => 'Remove Order Details']);



    Route::get('/reports/{type}', ['uses' => 'ReportsController@generateOrdersReport', 'as' => 'Generate Orders Report']);

    Route::get('/requisitions/generate', ['uses' => 'RequisitionsController@generateRequisition', 'as' => 'Generate Requisitions']);
    Route::get('/requisitions/getRequisitionItems', ['uses' => 'RequisitionsController@getRequisitionItems', 'as' => 'Generate Requisitions']);
    Route::post('/requisitions/generateRequisition', ['uses' => 'RequisitionsController@generateRequisitionItems', 'as' => 'Generate Requisitions']);
    Route::delete('/requisitions/{id}/{action}', ['uses' => 'RequisitionsController@destroy', 'as' => 'Remove Order Details']);
});