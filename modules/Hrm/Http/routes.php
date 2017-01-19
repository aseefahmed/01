<?php

Route::group(['middleware' => 'web', 'prefix' => 'hrm', 'namespace' => 'Modules\Hrm\Http\Controllers'], function()
{
	Route::post('employees/store', ['uses' => 'EmployeesController@store', 'as' => 'Save Employee']);
	Route::post('employees/changePass', ['uses' => 'EmployeesController@changePass', 'as' => 'Change Password']);
	Route::get('employees/changeUserFlag/{flag}/{user_id}', ['uses' => 'EmployeesController@changeFlag', 'as' => 'Flag']);
    Route::get('employees/fetchEmployeesList', ['uses' => 'EmployeesController@fetchEmployeesList', 'as' => 'Employees List']);
    Route::get('employees/fetchEmployeeDetails/{id}', ['uses' => 'EmployeesController@fetchEmployeeDetails', 'as' => 'Employee Details']);
    Route::get('employees/updateEmployeesInfo/{field}/{id}/{value}/{table_name}', ['uses' => 'EmployeesController@updateEmployeeDetails', 'as' => 'Employee Details']);
});