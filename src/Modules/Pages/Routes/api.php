<?php
Route::get('about' , 'ApiController@about');
Route::get('terms' , 'ApiController@terms');
Route::get('policy' , 'ApiController@policy');
Route::get('return_policy' , 'ApiController@return_policy');

Route::get('pages/{id?}' , 'ApiController@index');