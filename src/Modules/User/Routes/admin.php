<?php

use Modules\User\Controllers\Admin\{
    AdminController,
    ModeratorsController,
    RolesController,
};
Route::group(['namespace' => 'Admin','middleware'=>'auth:admin'] , function(){
    Route::get('all/notifications' , [AdminController::class,'notifications'])->name('notifications.page');
    Route::post('notifications/mark/read' , [AdminController::class,'markNotifyRead'])->name('notifications.read');
    Route::resource('users', AdminController::class);
    Route::post('saveToken', [AdminController::class,'saveToken'])->name('saveToken');

    Route::resource('roles', RolesController::class);
    Route::resource('moderators', ModeratorsController::class)->except(['show']);

    Route::get('user_active_status',[AdminController::class,'active_status'])->name('users.active_status');
});
