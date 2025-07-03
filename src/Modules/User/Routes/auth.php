<?php
use Modules\User\Controllers\{
    Admin\AdminController,
    WebController,
    Web\PasswordController,
};

Route::any('admin/login', [AdminController::class,'login']);
Route::any('admin/logout', [AdminController::class,'admin_logout'])->name('admin.logout');

Route::any('user/active/{token}', [WebController::class,'active'])->name('user.active');
Route::any('resend_code', [WebController::class,'resend_code'])->name('resend_code');
Route::get('logout', [WebController::class,'logout'])->name('logout');
Route::any('login', [WebController::class,'login'])->name('login');
Route::any('verify', [WebController::class,'verify'])->name('verify');
Route::any('register', [WebController::class,'register'])->name('register');
Route::any('signup', [WebController::class,'register'])->name('signup');


Route::any('password/reset/{token}', [WebController::class,'reset'])->name('password.reset');
Route::any('user/password_code/{token}',[PasswordController::class,'code'])->name('password.code');
Route::any('password/forget', [PasswordController::class,'forget'])->name('password.forget');
Route::any('password/reset/{token}', [PasswordController::class,'reset'])->name('password.reset');
