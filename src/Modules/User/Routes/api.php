<?php
Route::group(['namespace' => 'Api', 'middleware' => 'api'], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
    
    Route::post('forget', 'PasswordController@forget');
    Route::post('reset_code', 'PasswordController@reset_code');
    Route::post('reset', 'PasswordController@reset');

    Route::post('activate', 'ConfirmationController@activate');
    Route::post('resend_code', 'ConfirmationController@resend_code');

    // Route::get('profile/{id}', 'ApiController@show');
    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('myprofile', 'AuthController@myprofile');

        Route::get('logout', 'AuthController@logout');
        Route::delete('delete_account', 'AuthController@delete_account');
        Route::post('profile/edit', 'ApiController@update');
        Route::post('profile/edit_mobile', 'ApiController@edit_mobile');
        Route::post('profile/confirm_new_mobile', 'ApiController@confirm_new_mobile');
        Route::post('profile/change_password', 'ApiController@change_password');

        Route::get('notifications_toggle', 'NotificationController@toggle');
        Route::get('notifications', 'NotificationController@index');
        Route::get('notifications/{id}', 'NotificationController@seen');
    });
});
