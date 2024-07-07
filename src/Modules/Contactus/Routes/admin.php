<?php
Route::resource('contactus', 'AdminController')->only('index', 'show');
