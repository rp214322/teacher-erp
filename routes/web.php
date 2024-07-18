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

Route::redirect('/', '/admin')->name('home');
Route::get('fetch',[\App\Http\Controllers\Admin\HotelController::class,'fetch'])->name('fetchData');

//Admin Section
Route::get('admin/login',[\App\Http\Controllers\Admin\AuthController::class,'getLogin'])->name('admin.login');
Route::post('admin/login',[\App\Http\Controllers\Admin\AuthController::class,'postLogin'])->name('admin.post.login');

Route::middleware('admin')->prefix('admin')->namespace('\App\Http\Controllers\Admin')->name('admin.')->group(function(){

	Route::get('/',[\App\Http\Controllers\Admin\DashboardController::class,'index'])->name('dashboard');

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

    Route::resource('country',CountryController::class);

    Route::resource('city',CityController::class);

    Route::resource('hotel',HotelController::class);

    Route::resource('tour',TourController::class);

    Route::resource('airport',AirportController::class);

    Route::resource('train',TrainController::class);

    Route::resource('agent',AgentController::class);

    Route::resource('supplier',SupplierController::class);

    Route::get('/booking', [\App\Http\Controllers\Admin\BookingController::class, 'index'])->name('booking.index');
    Route::get('/booking/store', [\App\Http\Controllers\Admin\BookingController::class, 'create'])->name('booking.create');
    Route::get('/booking/show/{id}', [\App\Http\Controllers\Admin\BookingController::class, 'show'])->name('booking.show');
    Route::get('/booking/cp/{id}', [\App\Http\Controllers\Admin\BookingController::class, 'cp'])->name('booking.cp');
    Route::post('/booking', [\App\Http\Controllers\Admin\BookingController::class, 'store'])->name('booking.store');
    Route::get('/booking/{id}', [\App\Http\Controllers\Admin\BookingController::class, 'edit'])->name('booking.edit');
    Route::put('/booking/{id}', [\App\Http\Controllers\Admin\BookingController::class, 'update'])->name('booking.update');
    Route::delete('/booking/{id}', [\App\Http\Controllers\Admin\BookingController::class, 'destroy'])->name('booking.delete');
    //singlehotal 
    Route::get('/singlehotelbooking/{id}', [\App\Http\Controllers\Admin\BookingController::class, 'hotelbooking'])->name('singlehotelbooking');
    Route::get('/hotelbooking/create/{booking_id}', [\App\Http\Controllers\Admin\HotelBookingController::class, 'create'])->name('hotelbooking.create');
    Route::post('/hotelbooking/store/{booking_id}', [\App\Http\Controllers\Admin\HotelBookingController::class, 'store'])->name('hotelbooking.store');
    Route::get('/hotelbooking/{id}', [\App\Http\Controllers\Admin\HotelBookingController::class, 'edit'])->name('hotelbooking.edit');
    Route::put('/hotelbooking/{id}', [\App\Http\Controllers\Admin\HotelBookingController::class, 'update'])->name('hotelbooking.update');
    Route::delete('/hotelbooking/{id}', [\App\Http\Controllers\Admin\HotelBookingController::class, 'destroy'])->name('hotelbooking.delete');
    //singletour 
    Route::get('/singletourbooking/{id}', [\App\Http\Controllers\Admin\BookingController::class, 'tourbooking'])->name('singletourbooking');
    Route::get('/tourbooking/create/{booking_id}', [\App\Http\Controllers\Admin\TourBookingController::class, 'create'])->name('tourbooking.create');
    Route::post('/tourbooking/store/{booking_id}', [\App\Http\Controllers\Admin\TourBookingController::class, 'store'])->name('tourbooking.store');
    Route::get('/tourbooking/{id}', [\App\Http\Controllers\Admin\TourBookingController::class, 'edit'])->name('tourbooking.edit');
    Route::put('/tourbooking/{id}', [\App\Http\Controllers\Admin\TourBookingController::class, 'update'])->name('tourbooking.update');
    Route::delete('/tourbooking/{id}', [\App\Http\Controllers\Admin\TourBookingController::class, 'destroy'])->name('tourbooking.delete');
    //singleservices 
    Route::get('/singleservicesbooking/{id}', [\App\Http\Controllers\Admin\BookingController::class, 'servicesbooking'])->name('singleservicesbooking');
    Route::get('/miscbooking/create/{booking_id}', [\App\Http\Controllers\Admin\MiscController::class, 'create'])->name('miscbooking.create');
    Route::post('/miscbooking/store/{booking_id}', [\App\Http\Controllers\Admin\MiscController::class, 'store'])->name('miscbooking.store');
    Route::get('/miscbooking/{id}', [\App\Http\Controllers\Admin\MiscController::class, 'edit'])->name('miscbooking.edit');
    Route::put('/miscbooking/{id}', [\App\Http\Controllers\Admin\MiscController::class, 'update'])->name('miscbooking.update');
    Route::delete('/miscbooking/{id}', [\App\Http\Controllers\Admin\MiscController::class, 'destroy'])->name('miscbooking.delete');
    Route::post('/miscbookingcosting/store/{booking_id}', [\App\Http\Controllers\Admin\MiscController::class, 'miscbookingcostingstore'])->name('miscbookingcosting.store');
    //remarks 
    Route::post('/remark/store/{booking_id}', [\App\Http\Controllers\Admin\RemarkController::class, 'store'])->name('remark.store');
    Route::put('/remark/{id}', [\App\Http\Controllers\Admin\RemarkController::class, 'update'])->name('remark.update');
    Route::delete('/remark/{id}', [\App\Http\Controllers\Admin\RemarkController::class, 'destroy'])->name('remark.delete');

	// Route for Logout
	Route::post('logout',[\App\Http\Controllers\Admin\AuthController::class,'getLogout'])->name('admin.logout');

});
