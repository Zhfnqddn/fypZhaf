<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;

use App\Http\Controllers\ConfigController;

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
use App\Http\Controllers\StatusController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ToyyibpayController;


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
Route::get('/booking/{packageId}', [BookingController::class, 'showBookingPage'])->name('showBookingPage');
Route::post('/customize-package/{packageId}', [BookingController::class, 'customizePackage'])->name('customizePackage');
Route::get('/customize-package-form/{packageId}', [BookingController::class, 'showCustomizeForm'])->name('customizePackageForm');

Route::middleware('auth:customer')->group(function () {
Route::post('/process-customize-package/{packageId}', [BookingController::class, 'processCustomizePackage'])->name('processCustomizePackage');
});

Route::middleware('auth:customer')->group(function () {
    Route::post('/book-package/{packageId}', [BookingController::class, 'storeBooking'])->name('bookPackage');
});


Route::group(['middleware' => ['auth:staff']], function () {
    Route::get('pictures', [PortfolioController::class, 'indexPictures'])->name('staff.pictures.index');
    Route::post('pictures', [PortfolioController::class, 'storePicture'])->name('staff.pictures.store');
    Route::delete('pictures/{picture}', [PortfolioController::class, 'destroyPicture'])->name('staff.pictures.destroy');

    Route::get('videos', [PortfolioController::class, 'indexVideos'])->name('staff.videos.index');
    Route::post('videos', [PortfolioController::class, 'storeVideo'])->name('staff.videos.store');
    Route::delete('videos/{video}', [PortfolioController::class, 'destroyVideo'])->name('staff.videos.destroy');
});

Route::group(['middleware' => ['auth:staff']], function () {
Route::get('/accept-booking/{bookingId}', [StatusController::class, 'acceptBooking'])->name('accept-booking');
Route::get('/reject-booking/{bookingId}', [StatusController::class, 'rejectBooking'])->name('reject-booking');
Route::get('/bookings', [StatusController::class, 'showBookings'])->name('bookings');
});

Route::group(['middleware' => ['auth:staff']], function () {
    Route::get('/customizations', [StatusController::class, 'showCustomizations'])->name('customizations');
    Route::get('/accept-customization/{customizationId}', [StatusController::class, 'acceptCustomization'])->name('accept-customization');
    Route::get('/reject-customization/{customizationId}', [StatusController::class, 'rejectCustomization'])->name('reject-customization');
});

Route::get('/customer/bookings', [StatusController::class, 'showCustomerBookings'])->name('customer.bookings');
Route::post('/customer/bookings/{bookingId}/cancel', [StatusController::class, 'cancelBooking'])->name('customer.cancelBooking');
Route::post('/customer/bookings/{bookingId}/payment', [StatusController::class, 'makePayment'])->name('customer.makePayment');

Route::get('/customer/customizations', [StatusController::class, 'showCustomerCustomizations'])->name('customer.customizations');

Route::get('/payment', [PaymentController::class, 'payment'])->name('cust.payment');

Route::get(uri:'toyyibpay', action: 'ToyyibpayController@createBill')->name(name: 'toyyibpay-create');
Route::get(uri:'status', action: 'ToyyibpayController@paymentStatus')->name(name: 'toyyibpay-status');
Route::get(uri:'toyyibpay-callback', action: 'ToyyibpayController@callback')->name(name: 'toyyibpay-callback');

Route::get('toyyibpay/{bookingId}', [ToyyibpayController::class, 'createBill'])->name('toyyibpay-create');
Route::get('status/{bookingId}', [ToyyibpayController::class, 'paymentStatus'])->name('toyyibpay-status');
Route::post('toyyibpay-callback', [ToyyibpayController::class, 'callback'])->name('toyyibpay-callback');


Route::get('/check-php-config', function() {
    Log::info('upload_max_filesize: ' . ini_get('upload_max_filesize'));
    Log::info('post_max_size: ' . ini_get('post_max_size'));

    return response()->json([
        'upload_max_filesize' => ini_get('upload_max_filesize'),
        'post_max_size' => ini_get('post_max_size'),
    ]);
});

Route::get('/check-php-config', [ConfigController::class, 'checkPhpConfig']);