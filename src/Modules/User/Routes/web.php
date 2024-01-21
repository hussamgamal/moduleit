<?php
Route::any('admin/login', 'Admin\AdminController@login');

Route::group(['namespace' => 'Web'], function () {
    Route::resource('users', 'WebController');
    Route::any('login', 'AuthController@login')->name('login');
    Route::any('activate/{token}', 'AuthController@activate')->name('activate');
    Route::any('register', 'AuthController@register')->name('register');

    Route::group(['middleware' => 'auth'], function () {
        Route::any('profile/edit', 'ProfileController@edit')->name('profile.edit');
        Route::get('profile/logout', 'ProfileController@logout')->name('logout');

        Route::get('notifications', 'ProfileController@notifications')->name('notifications');

        Route::get('payments' , 'PaymentController@index')->name('payments.index');
        Route::any('payments/{id}/pay' , 'PaymentController@pay')->name('payments.pay');

        Route::any('password/change' , 'PasswordController@change')->name('password.change');
    });
    Route::any('password/forget' , 'PasswordController@forget')->name('password.forget');
    Route::any('password/reset/{mobile}' , 'PasswordController@reset')->name('password.reset');
    Route::any('password/new/{mobile}' , 'PasswordController@new')->name('password.new');
});
