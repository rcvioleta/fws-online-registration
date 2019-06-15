<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/register', function () {
    return redirect()->route('home');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::resource('/event', 'EventController');

    Route::get('/get-events', 'EventController@getEvents');

    Route::resource('/campaign', 'CampaignController');

    Route::get('/campaign/{campaign}/activate', 'CampaignController@activate')->name('campaign.activate');

    Route::get('/campaign/{campaign}/deactivate', 'CampaignController@deactivate')->name('campaign.deactivate');

    Route::resource('/employee', 'EmployeeController');

    Route::group(['prefix' => 'get'], function () {
        Route::get('/employees', 'EmployeeController@getEmployees');
    });

    Route::get('/employee/{id}/activate', 'EmployeeController@activate')->name('employee.activate');

    Route::get('/employee/{id}/deactivate', 'EmployeeController@deactivate')->name('employee.deactivate');

    Route::resource('/registration', 'RegistrationController');

    Route::group(['prefix' => 'event'], function () {
        Route::get('/{id}/registration', 'RegistrationController@serve');
        Route::get('/{id}/register', 'RegistrationController@register');
        Route::get('/{events}/report', 'RegistrationController@history')->name('registration.report');
        Route::get('/{id}/history', 'EventController@checkEventHistory')->name('event.history');
    });

    Route::get('/show-registration/{data}', 'RegistrationController@showRegistration')->name('registration.showRegistration');

    Route::get('/generate-registration', 'RegistrationController@generate')->name('registration.generate');
});
