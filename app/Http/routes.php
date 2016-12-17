<?php

Route::group(['middlewere' => 'web'], function(){
    Route::get('/', ['uses' => 'LoginController@isUserLoggedIn', 'as' => 'Authentication Check']);
    Route::get('/login', ['uses' => 'LoginController@index', 'as' => 'Login']);
    Route::get('/logout', ['uses' => 'LoginController@doLogout', 'as' => 'Logout']);
    Route::post ('/process-login', ['uses' => 'LoginController@processLogin', 'as' => 'Process Login']);
    Route::get('/dashboard', ['uses' => 'DashboardController@viewDashboard', 'as' => 'Dashboard']);
    Route::get('/styles', ['uses' => 'Test1Controller@viewDashboard', 'as' => 'Dashboard']);

    Route::get('/user/getUsersList{cond?}', ['uses' => 'UserController@getUsersList', 'as' => 'Users List']);

    Route::get('/cockpit', ['uses' => 'DashboardController@viewCockpit', 'as' => 'Freelance Cockpit']);
});