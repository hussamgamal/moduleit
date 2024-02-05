<?php
Route::group(['namespace' => 'Admin'], function () {
    Route::get('/', 'AdminController@home')->name('home');
    Route::get('/loading', 'AdminController@load')->name('load');

    Route::any('notifications/{id?}', 'NotificationController@notifications')->name('notifications');
    Route::delete('notifications/{id}/delete', 'NotificationController@notifications_delete')->name('notifications.destroy');

    Route::resource('home_sections', 'SectionsController');

    Route::match(['get', 'post'], 'home', 'SettingsController@home')->name('settings.home');
    Route::match(['get', 'post'], 'newsletter', 'SettingsController@newsletter')->name('settings.newsletter');
    Route::match(['get', 'post'], 'settings', 'SettingsController@settings')->name('settings.app');
    Route::match(['get', 'post'], 'store', 'SettingsController@store')->name('settings.store');
    Route::match(['get', 'post'], 'app_links', 'SettingsController@app_links')->name('settings.app_links');
    Route::match(['get', 'post'], 'contacts', 'SettingsController@contacts')->name('settings.contacts');
    Route::get('remove_contact', 'SettingsController@remove_contact')->name('remove_contact');
    Route::match(['get', 'post'], 'messages', 'SettingsController@messages')->name('settings.messages');
    Route::match(['get', 'post'], 'days_off', 'SettingsController@days_off')->name('settings.days_off');
});
