<?php

use Modules\Contactus\Controllers\{
    WebController
};

Route::any('contactus' , [WebController::class,'contactus'])->name('contactus');
Route::any('merchant_request' , [WebController::class,'request'])->name('request');
