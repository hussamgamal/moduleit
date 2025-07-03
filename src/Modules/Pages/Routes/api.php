<?php
use Modules\Pages\Controllers\{
    ApiController
};
Route::get('about' , [ApiController::class,'about']);
Route::get('terms' , [ApiController::class,'terms']);
Route::get('policy' , [ApiController::class,'policy']);
Route::get('return_policy' , [ApiController::class,'return_policy']);

Route::get('pages/{id?}' , [ApiController::class,'index']);
