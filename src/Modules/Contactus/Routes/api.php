<?php

use Modules\Contactus\Controllers\{
    ApiController
};
Route::any('contactus', [ApiController::class,'contactus']);
