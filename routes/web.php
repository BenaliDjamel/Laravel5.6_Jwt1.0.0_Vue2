<?php
use Illuminate\Http\Request;



Route::get('{any}', function () {
    return view('welcome');
})->where('any', '.*');
