<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/{pathMatch}', function () {
    return view('welcome');
})->where('pathMatch', '.*');

Route::get('/login', function () {
    return view('auth.login');
});

Route::post('registerUser' , [AuthController::class , 'register']);

Route::post('loginUser', [AuthController::class, 'login']);
