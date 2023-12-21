<?php
Route::get('remove_img', 'Admin/AdminController@remove_img')->name('remove_img');

Route::get('change_locale', function () {
    if (app()->getLocale() == 'ar') {
        session()->put('current_locale', 'en');
    } else {
        session()->put('current_locale', 'ar');
    }
    return back();
})->name('change_locale');

Route::resource('common', 'SiteController');
