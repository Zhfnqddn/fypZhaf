<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ViewCustController; 
use App\Http\Controllers\UpdCustController;
use App\Http\Controllers\ViewStaffController;
use App\Http\Controllers\UpdStaffController;
use App\Models\Package;
use App\Http\Controllers\EventController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PortfolioController;


Route::get('/', [DashboardController::class, 'home'])->name('home');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth:customer')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
});

Route::middleware('auth:staff')->group(function () {
    Route::get('/dashboardStaff', [DashboardController::class, 'dashboardStaff'])->name('dashboardStaff');
});

Route::middleware('auth:customer')->group(function () {
    Route::get('/viewCust', [ViewCustController::class, 'viewCust'])->name('viewCust');
    Route::post('/updateCust', [ViewCustController::class, 'updateCust'])->name('updateCust');
    Route::get('/updCust', [UpdCustController::class, 'updCust'])->name('updCust');
});

Route::middleware(['auth:staff'])->group(function () {
    Route::get('/viewStaff', [ViewStaffController::class, 'viewStaff'])->name('viewStaff');
    Route::post('/updateStaff', [ViewStaffController::class, 'updateStaff'])->name('updateStaff');
    Route::get('/updStaff', [UpdStaffController::class, 'updStaff'])->name('updStaff');
});

Route::group(['middleware' => ['auth:staff']], function () {
    Route::post('/events', [EventController::class, 'store'])->name('events.store');
    Route::put('events/{package}', [EventController::class, 'update'])->name('events.update');
    Route::get('events/list', [EventController::class, 'listEvent'])->name('events.list');
    Route::resource('events', EventController::class);
    // Remove or correct the following line
    // Route::get('/event', [EventController::class, 'event'])->name('event');
    Route::get('events', [EventController::class, 'index'])->name('events.index'); // Updated to use 'events.index'
});

Route::get('/filter', [BookingController::class, 'filter'])->name('filter');
Route::get('/booking', [BookingController::class, 'booking'])->name('booking');
Route::get('/list-booking', [BookingController::class, 'list'])->name('listBooking');
Route::get('/booking/{packageId}/{custId}', [BookingController::class, 'showBookingPage'])->name('showBookingPage');
Route::post('/make-booking', [BookingController::class, 'makeBooking'])->name('makeBooking');


Route::group(['middleware' => ['auth:staff']], function () {
    Route::get('pictures', [PortfolioController::class, 'indexPictures'])->name('staff.pictures.index');
    Route::post('pictures', [PortfolioController::class, 'storePicture'])->name('staff.pictures.store');
    Route::delete('pictures/{picture}', [PortfolioController::class, 'destroyPicture'])->name('staff.pictures.destroy');

    Route::get('videos', [PortfolioController::class, 'indexVideos'])->name('staff.videos.index');
    Route::post('videos', [PortfolioController::class, 'storeVideo'])->name('staff.videos.store');
    Route::delete('videos/{video}', [PortfolioController::class, 'destroyVideo'])->name('staff.videos.destroy');
});
