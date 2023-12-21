<?php
Route::group(['namespace' => 'Admin'] , function(){
    Route::resource('users', 'AdminController');
    
    Route::resource('roles', 'RolesController');
    Route::resource('moderators', 'ModeratorsController');

    Route::get('user_active_status', 'AdminController@active_status')->name('users.active_status');
});