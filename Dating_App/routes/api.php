<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\AdminAPI\HomeController;
use App\Http\Controllers\AdminController;




Route::group([
    'middleware' => 'api'

], function () {
   Route::post('login', [AuthController::class, 'login']);
   Route::post('register', [AuthController::class, 'register']);
   Route::post('logout', [AuthController::class, 'logout']);
   Route::post('refresh', [AuthController::class, 'refresh']);
   Route::get('user-profile', [AuthController::class, 'userProfile']);
   Route::post('/editprofile', [UserController::class, 'editprofile'])->name('api:editprofile');
   Route::get('/allusers', [UserController::class, 'allusers'])->name('api:allusers');
   Route::get('/showfavorites', [UserController::class, 'showfavorites'])->name('api:showfavorite');
   Route::get('/showmatched', [UserController::class, 'showmatched'])->name('api:showmatched');
   Route::get('/showblocked', [UserController::class, 'showblocked'])->name('api:showblocked');
   Route::get('/notifs', [UserController::class, 'notifications'])->name('api:notifs');
   Route::get('/mypics', [UserController::class, 'mypictures'])->name('api:mypics');
   Route::get('/userpics', [UserController::class, 'userpictures'])->name('api:userpics');
   Route::get('/userprofile', [UserController::class, 'userprofile'])->name('api:userprofile');
   Route::get('/myprofile', [UserController::class, 'myprofile'])->name('api:myprofile');
   Route::get('/makefavorite', [UserController::class, 'makefavorite'])->name('api:makefavorite');
   Route::get('/block', [UserController::class, 'block'])->name('api: block');
   Route::get('/unblock', [UserController::class, 'unblock'])->name('api:unblock');
});





//Route::get('/editinterest', [UserController::class, 'einterest'])->name('api:editinterest');
//Route::get('/edithobbies', [UserController::class, 'ehobbies'])->name('api:edithobbies');
//Route::get('/editpictures', [UserController::class, 'epictures'])->name('api:editpictures');
Route::post('/loginadmin', [AdminController::class, "login"])->name("loginadmin");


Route::get('/approvepic', [HomeController::class, 'approvePic'])->name('api:approvepic');
Route::get('/approvemsg', [HomeController::class, 'approveMsg'])->name('api:approvemsg');
Route::get('/declinepic', [HomeController::class, 'declinePic'])->name('api:declinepic');
Route::get('/declinemsg', [HomeController::class, 'declineMsg'])->name('api:declinemsg');

?>

