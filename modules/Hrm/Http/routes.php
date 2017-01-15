<?php

Route::group(['middleware' => 'web', 'prefix' => 'hrm', 'namespace' => 'Modules\Hrm\Http\Controllers'], function()
{
    Route::get('employees/fetchEmployeesList', ['uses' => 'EmployeesController@fetchEmployeesList', 'as' => 'Employees List']);
});