<?php
Route::group(['namespace' => 'Admin'] , function(){
    Route::resource('users', 'AdminController');
    Route::resource('visitors', 'VisitorController');
    Route::resource('owners', 'OwnerController');
    
    Route::resource('roles', 'RolesController');
    Route::resource('moderators', 'ModeratorsController');

    Route::resource('payments', 'PaymentsController');

    Route::get('user_active_status', 'AdminController@active_status')->name('users.active_status');
});