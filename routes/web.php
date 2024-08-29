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
Route::get('login',[\App\Http\Controllers\AuthController::class,'getLogin'])->name('admin.login');
Route::post('login',[\App\Http\Controllers\AuthController::class,'postLogin'])->name('admin.post.login');

Route::middleware('admin')->namespace('\App\Http\Controllers')->name('admin.')->group(function(){

	Route::get('dashboard',[\App\Http\Controllers\DashboardController::class,'index'])->name('dashboard');

	// Route for profile
	Route::get('profile',[\App\Http\Controllers\AuthController::class,'getProfile'])->name('profile');
	Route::post('profile',[\App\Http\Controllers\AuthController::class,'postProfile'])->name('post.profile');

	// Route for Change Password
	Route::get('password',[\App\Http\Controllers\AuthController::class,'getPassword'])->name('password');
	Route::post('password',[\App\Http\Controllers\AuthController::class,'postPassword'])->name('post.password');

    Route::resource('users',UsersController::class);

	//program
	Route::get('/program',[\App\Http\Controllers\ProgramController::class,'index'])->name('program.index');
	Route::get('program/store',[\App\Http\Controllers\ProgramController::class,'create'])->name('program.create');
	Route::post('program',[\App\Http\Controllers\ProgramController::class,'store'])->name('program.store');
	Route::get('program/{id}',[\App\Http\Controllers\ProgramController::class,'edit'])->name('program.edit');
	Route::put('/program/{id}', [\App\Http\Controllers\ProgramController::class, 'update'])->name('program.update');
	Route::delete('/program/{id}', [\App\Http\Controllers\ProgramController::class, 'destroy'])->name('program.delete');
	//subject
	Route::get('/subject',[\App\Http\Controllers\SubjectController::class,'index'])->name('subject.index');
	Route::get('subject/store',[\App\Http\Controllers\SubjectController::class,'create'])->name('subject.create');
	Route::post('subject',[\App\Http\Controllers\SubjectController::class,'store'])->name('subject.store');
	Route::get('subject/{id}',[\App\Http\Controllers\SubjectController::class,'edit'])->name('subject.edit');
	Route::put('/subject/{id}', [\App\Http\Controllers\SubjectController::class, 'update'])->name('subject.update');
	Route::delete('/subject/{id}', [\App\Http\Controllers\SubjectController::class, 'destroy'])->name('subject.delete');

	// Route for Logout
	Route::post('logout',[\App\Http\Controllers\AuthController::class,'getLogout'])->name('admin.logout');

});
