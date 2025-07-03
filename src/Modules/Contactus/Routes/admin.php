<?php
use Modules\Contactus\Controllers\{
    AdminController
};
Route::group(['middleware'=>'auth:admin'] , function() {
    Route::resource('contactus', AdminController::class)->only('index', 'show');
});
