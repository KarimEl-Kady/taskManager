<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Catogry\CatogryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('registerUser' , [AuthController::class , 'register']);

Route::post('loginUser', [AuthController::class, 'login']);


Route::group(
    [
        'middleware' => ['auth:sanctum'],
    ],
    function () {
        Route::get('/', function () {
            return view('welcome');
        });

    Route::get('getCatogry' , [CatogryController::class , 'getCatogry']);
    Route::post('createCatogry' , [CatogryController::class , 'createCatogry']);
    Route::get('getCatogryById/{id}' , [CatogryController::class , 'getCatogryById']);
    Route::put('updateCatogry/{id}' , [CatogryController::class , 'updateCatogry']);
    Route::delete('deleteCatogry/{id}' , [CatogryController::class , 'deleteCatogry']);
    Route::get('getDeletedCategories' , [CatogryController::class , 'getDeletedCategories']);
    Route::put('restore/{id}' , [CatogryController::class , 'restore']);
    Route::delete('forceDelete/{id}' , [CatogryController::class , 'forceDelete']);
    });
