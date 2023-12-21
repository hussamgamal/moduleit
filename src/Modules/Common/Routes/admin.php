<?php
Route::group(['namespace' => 'Admin'], function () {
    Route::get('/', 'AdminController@home')->name('home');
    Route::get('/loading', 'AdminController@load')->name('load');

    Route::any('notifications/{id?}', 'NotificationController@notifications')->name('notifications');
    Route::delete('notifications/{id}/delete', 'NotificationController@notifications_delete')->name('notifications.destroy');

    Route::resource('home_sections', 'SectionsController');

    Route::match(['get', 'post'], 'settings', 'Settingstroller@settings')->name('settings.app');
    Route::match(['get', 'post'], 'app_links', 'Settingstroller@app_links')->name('settings.app_links');
    Route::match(['get', 'post'], 'contacts', 'Settingstroller@contacts')->name('settings.contacts');
    Route::get('remove_contact', 'Settingstroller@remove_contact')->name('remove_contact');
});
