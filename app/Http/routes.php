<?php

Route::group(['middlewere' => 'web'], function(){
    Route::post ('/process-login', ['uses' => 'LoginController@processLogin', 'as' => 'Process Login']);
    Route::get('/', ['uses' => 'LoginController@isUserLoggedIn', 'as' => 'Authentication Check']);
    Route::get('/login', ['uses' => 'LoginController@index', 'as' => 'Login']);
    Route::post('/register', ['uses' => 'LoginController@registerUser', 'as' => 'Registration']);
    Route::get('/getUsers/{user_id}', ['uses' => 'LoginController@getUsers', 'as' => 'Users List']);
    Route::get('/logout/{user_id}', ['uses' => 'LoginController@doLogout', 'as' => 'Logout']);
    Route::get('/dashboard', ['uses' => 'DashboardController@viewDashboard', 'as' => 'Dashboard']);
    Route::get('/getToken', ['uses' => 'LoginController@get_token', 'as' => 'CSRF Token']);

    Route::get('/styles', ['uses' => 'Test1Controller@viewDashboard', 'as' => 'Dashboard']);

    Route::get('/user/getUsersList{cond?}', ['uses' => 'UserController@getUsersList', 'as' => 'Users List']);

    Route::get('/cockpit', ['uses' => 'DashboardController@viewCockpit', 'as' => 'Freelance Cockpit']);

    Route::get('/employees/fetchEmployeesList', ['uses' => 'EmployeesController@fetchEmployeesList', 'as' => 'Employees List']);
    Route::post('employees/store', ['uses' => 'EmployeesController@store', 'as' => 'Save Employee']);
    Route::post('employees/changePass', ['uses' => 'EmployeesController@changePass', 'as' => 'Change Password']);
    Route::get('employees/changeUserFlag/{flag}/{user_id}/{logged_in_user}', ['uses' => 'EmployeesController@changeFlag', 'as' => 'Flag']);
    Route::get('employees/fetchEmployeeDetails/{id}', ['uses' => 'EmployeesController@fetchEmployeeDetails', 'as' => 'Employee Details']);
    Route::post('/employee/delete', ['uses' => 'EmployeesController@deleteEmployee', 'as' => 'Remove Buyer Details']);
    Route::post('employee/uploadFiles/', ['uses' => 'EmployeesController@uploadFiles', 'as' => 'File Upload']);
    Route::get('employees/updateEmployeesInfo/{field}/{id}/{value}/{table_name}/{logged_in_user}', ['uses' => 'EmployeesController@updateEmployeeDetails', 'as' => 'Employee Details']);

    
});