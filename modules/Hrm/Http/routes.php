<?php

Route::group(['middleware' => 'web', 'prefix' => 'hrm', 'namespace' => 'Modules\Hrm\Http\Controllers'], function()
{
	Route::post('employees/store', ['uses' => 'EmployeesController@store', 'as' => 'Save Employee']);
    Route::get('employees/fetchEmployeesList', ['uses' => 'EmployeesController@fetchEmployeesList', 'as' => 'Employees List']);
});