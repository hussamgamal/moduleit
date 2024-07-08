<?php

use Modules\User\Controllers\Admin\{
    AdminController
};
Route::group(['namespace' => 'Admin'] , function(){
    Route::get('all/notifications' , [AdminController::class,'notifications'])->name('notifications.page');
    Route::post('notifications/mark/read' , [AdminController::class,'markNotifyRead'])->name('notifications.read');
    Route::resource('users', AdminController::class);
    Route::post('saveToken', [AdminController::class,'saveToken'])->name('saveToken');

    Route::resource('roles', 'RolesController');
    Route::resource('moderators', 'ModeratorsController');

    Route::get('user_active_status',[AdminController::class,'active_status'])->name('users.active_status');
});
