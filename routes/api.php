<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Catogry\CatogryController;
use App\Http\Controllers\Task\TaskController;
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

    Route::get('getTasks' , [TaskController::class , 'getTasks']);
    Route::post('createTask' , [TaskController::class , 'createTask']);
    Route::get('getTaskById/{id}' , [TaskController::class , 'getTaskById']);
    Route::put('updateTask/{id}' , [TaskController::class , 'updateTask']);
    Route::delete('deleteTask/{id}' , [TaskController::class , 'deleteTask']);
    Route::get('getDeletedCategories' , [TaskController::class , 'getDeletedCategories']);
    Route::put('restoreTask/{id}' , [TaskController::class , 'restore']);
    Route::delete('forceDeleteTask/{id}' , [TaskController::class , 'forceDelete']);
    });
