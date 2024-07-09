<?php
use Modules\User\Controllers\Web\{
    AuthController,
    WebController,
    ProfileController,
    PaymentController,
    PasswordController,
};
include __DIR__ . '/auth.php';

Route::group(['namespace' => 'Web'], function () {
    Route::resource('users', WebController::class);
    Route::any('login', [AuthController::class,'login'])->name('login');
    Route::any('activate/{token}', [AuthController::class,'activate'])->name('activate');
    Route::any('register', [AuthController::class,'register'])->name('register');

    Route::group(['middleware' => 'auth'], function () {
        Route::any('profile/edit', [ProfileController::class,'edit'])->name('profile.edit');
        Route::get('profile/logout', [ProfileController::class,'logout'])->name('logout');

        Route::get('notifications', [ProfileController::class,'notifications'])->name('notifications');

        Route::get('payments' , [PaymentController::class,'index'])->name('payments.index');
        Route::any('payments/{id}/pay' , [PaymentController::class,'pay'])->name('payments.pay');

        Route::any('password/change' , [PasswordController::class,'change'])->name('password.change');
    });
    Route::any('password/forget' , [PasswordController::class,'forget'])->name('password.forget');
    Route::any('password/reset/{mobile}' , [PasswordController::class,'reset'])->name('password.reset');
    Route::any('password/new/{mobile}' , [PasswordController::class,'new'])->name('password.new');
});
