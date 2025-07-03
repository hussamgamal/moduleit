<?php


use Modules\User\Controllers\Api\{
    AuthController,
    PasswordController,
    ConfirmationController,
    ApiController,
};
use Modules\Common\Controllers\Api\{
    NotificationController,
};
Route::group(['namespace' => 'Api', 'middleware' => 'api'], function () {
    Route::post('login', [AuthController::class,'login']);
    Route::post('signup', [AuthController::class,'signup']);

    Route::post('forget', [PasswordController::class,'forget']);
    Route::post('reset_code', [PasswordController::class,'reset_code']);
    Route::post('reset', [PasswordController::class,'reset']);

    Route::post('activate', [ConfirmationController::class,'activate']);
    Route::post('resend_code', [ConfirmationController::class,'resend_code']);

    // Route::get('profile/{id}', [ApiController::class,'show');]
    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('myprofile', [AuthController::class,'myprofile']);

        Route::get('logout', [AuthController::class,'logout']);
        Route::delete('delete_account', [AuthController::class,'delete_account']);
        Route::post('profile/edit', [ApiController::class,'update']);
        Route::post('profile/edit_mobile', [ApiController::class,'edit_mobile']);
        Route::post('profile/confirm_new_mobile', [ApiController::class,'confirm_new_mobile']);
        Route::post('profile/change_password', [ApiController::class,'change_password']);

    });
});
