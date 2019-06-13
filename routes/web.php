<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/register', function () {
    return redirect()->route('home');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/event', 'EventController');
Route::resource('/campaign', 'CampaignController');
Route::get('/campaign/{campaign}/activate', 'CampaignController@activate')->name('campaign.activate');
Route::get('/campaign/{campaign}/deactivate', 'CampaignController@deactivate')->name('campaign.deactivate');
Route::resource('/employee', 'EmployeeController');
Route::get('/employee/{campaign}/activate', 'EmployeeController@activate')->name('employee.activate');
Route::get('/employee/{campaign}/deactivate', 'EmployeeController@deactivate')->name('employee.deactivate');
Route::resource('/registration', 'RegistrationController');
