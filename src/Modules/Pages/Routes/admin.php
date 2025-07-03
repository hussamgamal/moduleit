<?php

use Modules\Pages\Controllers\{
    AdminController
};

Route::group(['middleware'=>'auth:admin'] , function() {
    Route::resource('pages', AdminController::class);
});
