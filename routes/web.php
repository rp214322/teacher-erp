<?php

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

Auth::routes();

Route::redirect('/', '/dashboard')->name('home');

//Admin Section
Route::get('login',[\App\Http\Controllers\Admin\AuthController::class,'getLogin'])->name('admin.login');
Route::post('login',[\App\Http\Controllers\Admin\AuthController::class,'postLogin'])->name('admin.post.login');

Route::middleware('admin')->namespace('\App\Http\Controllers\Admin')->name('admin.')->group(function(){

	Route::get('dashboard',[\App\Http\Controllers\Admin\DashboardController::class,'index'])->name('dashboard');

	// Route for profile
	Route::get('profile',[\App\Http\Controllers\Admin\AuthController::class,'getProfile'])->name('profile');
	Route::post('profile',[\App\Http\Controllers\Admin\AuthController::class,'postProfile'])->name('post.profile');

	// Route for Change Password
	Route::get('password',[\App\Http\Controllers\Admin\AuthController::class,'getPassword'])->name('password');
	Route::post('password',[\App\Http\Controllers\Admin\AuthController::class,'postPassword'])->name('post.password');

	// Route for Setting
    Route::get('settings',[\App\Http\Controllers\Admin\DashboardController::class,'settings'])->name('setting');
    Route::post('settings',[\App\Http\Controllers\Admin\DashboardController::class,'post_settings'])->name('post.setting');

    Route::resource('users',UsersController::class);

	// Route for Logout
	Route::post('logout',[\App\Http\Controllers\Admin\AuthController::class,'getLogout'])->name('admin.logout');

});
