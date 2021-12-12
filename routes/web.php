<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});
//Route::get('/login',[AdminController::class,'default']);
Route::group([
    'prefix'=>config('admin.prefix'),
    'namespace'=>'App\\Http\\Controllers',
],function(){
    Route::get('/login',[AdminController::class,'formLogin'])->name('admin.login');
    Route::post('login',[AdminController::class,'login']);

    Route::middleware(['auth'])->group(function() {
        Route::post('logout',[AdminController::class,'logout'])->name('admin.logout');
        Route::view('/','dashboard')->name('dashboard');
    });
});