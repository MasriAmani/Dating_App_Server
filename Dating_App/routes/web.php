<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ['guest']], function(){
Route::get('/', [AdminController::class, "index"])->name("index");
Route::get('/admin',[AdminController::class, "admin"])->name("admin");
Route::any('/logout',[AdminController::class, "logout"])->name("adminlogout");
Route::get('/adminmsgs', [AdminController::class, 'adminmsgs'])->name('adminmsgs');
});

Route::group(['middleware' => ['auth1']], function(){
        Route::group(['middleware' => ['auth.admin']], function(){
  
        
  });
	
  
 
});
?>

	