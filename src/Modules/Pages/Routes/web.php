<?php
use Modules\Pages\Controllers\{
    WebController
};

Route::get('pages/{type}', [WebController::class,'show'])->name('pages.show');
