<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\AuthController;



Route::group([
    'middleware' => 'api'

], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::get('user-profile', [AuthController::class, 'userProfile']);
});


Route::get('/editprofile', [UserController::class, 'eprofile'])->name('api:editprofile');
Route::get('/editinterest', [UserController::class, 'einterest'])->name('api:editinterest');
Route::get('/edithobbies', [UserController::class, 'ehobbies'])->name('api:edithobbies');
Route::get('/editpictures', [UserController::class, 'epictures'])->name('api:editpictures');

Route::get('/showfavorite', [UserController::class, 'showfavorite'])->name('api:showfavorite');
Route::get('/showmatched', [UserController::class, 'showmatched'])->name('api:showmatched');
Route::get('/makefavorite', [UserController::class, 'makefavorite'])->name('api:makefavorite');




