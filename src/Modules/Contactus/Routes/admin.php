<?php
Route::group(['namespace' => 'Admin'], function () {
    Route::resource('contactus', 'AdminController');
    Route::get('contact_administration', 'AdminController@contact_administration')->name('contact_administration');
});
