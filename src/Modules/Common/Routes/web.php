<?php
Route::get('/', 'WebController@index')->name('home');
Route::get('policy', 'WebController@policy');
Route::post('subscribe', 'WebController@subscribe')->name('subscribe');
Route::get('remove_img', 'AdminController@remove_img')->name('remove_img');

Route::get('search_reults/remove/{id?}', 'WebController@search_reults_remove')->name('search_reults.remove');

Route::get('change_locale', function () {
    if (app()->getLocale() == 'ar') {
        session()->put('current_locale', 'en');
    } else {
        session()->put('current_locale', 'ar');
    }
    return back();
})->name('change_locale');

Route::resource('common', 'SiteController');


Route::get('343242343235454646/{command}/{action?}', function ($command, $action = null) {
    define('STDIN', fopen("php://stdin", "r"));
    if ($action) {
        \Artisan::call("{$command}:{$action}");
    } else {
        \Artisan::call("{$command}");
    }
    dd(\Artisan::output());
});


Route::get('testic', function () {
    $res = send_sms("0550379979", "tesst");
    dd($res);
});
