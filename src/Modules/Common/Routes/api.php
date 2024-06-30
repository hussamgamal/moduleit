<?php
use Modules\Common\Controllers\ApiController;

Route::get('home', [ApiController::class,'home']);
Route::group(['middlewares'=>['auth:sanctum','auth-check']],function (){
    Route::get('notifications', [ApiController::class,'notifications']);
    Route::delete('notifications/{uuid}', [ApiController::class,'deleteNotification']);
    Route::post('notify-status', [ApiController::class,'notifyStatus']);
    Route::post('change-lang', [ApiController::class,'changeLang']);
});
