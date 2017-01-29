<?php

Route::group(['middleware' => 'web', 'prefix' => 'hrm', 'namespace' => 'Modules\Hrm\Http\Controllers'], function()
{
	Route::post('employees/store', ['uses' => 'EmployeesController@store', 'as' => 'Save Employee']);
	Route::post('employees/changePass', ['uses' => 'EmployeesController@changePass', 'as' => 'Change Password']);
	Route::get('employees/changeUserFlag/{flag}/{user_id}/{logged_in_user}', ['uses' => 'EmployeesController@changeFlag', 'as' => 'Flag']);
    Route::get('employees/fetchEmployeesList', ['uses' => 'EmployeesController@fetchEmployeesList', 'as' => 'Employees List']);
    Route::get('employees/fetchEmployeeDetails/{id}', ['uses' => 'EmployeesController@fetchEmployeeDetails', 'as' => 'Employee Details']);
    Route::post('/employee/delete', ['uses' => 'EmployeesController@deleteEmployee', 'as' => 'Remove Buyer Details']);
    Route::post('employee/uploadFiles/', ['uses' => 'EmployeesController@uploadFiles', 'as' => 'File Upload']);
	Route::get('employees/updateEmployeesInfo/{field}/{id}/{value}/{table_name}/{logged_in_user}', ['uses' => 'EmployeesController@updateEmployeeDetails', 'as' => 'Employee Details']);
});