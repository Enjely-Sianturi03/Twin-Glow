<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
// =======
// use App\Http\Controllers\HomeController;
// >>>>>>> fffb39338c68f80768a0eb6627658f0545b222cb
use App\Models\Booking;

// Main page
Route::get('/', [HomeController::class, 'index'])->name('home');

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Booking Routes
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
Route::get('/booking/create', [BookingController::class, 'create'])->name('booking.create');

// =======
// Route::get('admin/booking/riwayat', [BookingController::class, 'riwayat'])->name('admin.booking.riwayat');
// Route::delete('admin/booking/{id}', [BookingController::class, 'destroy'])->name('admin.booking.destroy');
// >>>>>>> fffb39338c68f80768a0eb6627658f0545b222cb

// Contact/Testimonial Routes
Route::get('/contact', [ContactController::class, 'index'])->name('contact.form');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Testimonial routes
Route::post('/testimonials', [TestimonialController::class, 'store'])->name('testimonials.store');
Route::get('/testimonials', [TestimonialController::class, 'index'])->name('testimonials.index');

// Checkout Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/checkout/{booking}', [CheckoutController::class, 'show'])->name('checkout.show');
    Route::post('/checkout/{booking}/process', [CheckoutController::class, 'process'])->name('checkout.process');
    
    // Invoice Routes
    Route::get('/invoice/{invoice}', [InvoiceController::class, 'show'])->name('invoice.show');
    Route::get('/invoice/{invoice}/download', [InvoiceController::class, 'download'])->name('invoice.download');
});

// Admin Routes
Route::prefix('admin')->group(function () {
    // Public admin routes (login)
    Route::get('login', [AdminController::class, 'showLogin'])->name('admin.login');
    Route::post('login', [AdminController::class, 'login']);
    Route::post('logout', [AdminController::class, 'logout'])->name('admin.logout');
    
    // Protected admin routes
  
    Route::middleware(['auth', 'admin'])->group(function () {
    // Route::get('/', 'App\\Http\\Controllers\\Admin\\AdminController@dashboard')->name('admin.dashboard');
   
    });
});

Route::prefix('admin')->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('booking', BookingController::class);
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/booking', [BookingController::class, 'index'])->name('booking.index');
    Route::get('/booking/{id}/edit', [BookingController::class, 'edit'])->name('booking.edit');
    Route::put('/booking/{id}', [BookingController::class, 'update'])->name('booking.update');
    Route::get('/booking/riwayat', [BookingController::class, 'riwayat'])->name('booking.riwayat');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users');

Route::get('/admin/contact', [ContactController::class, 'index'])->name('admin.contact.index');
// =======
// Route::post('/admin/users/{id}/toggle-block', [UserController::class, 'toggleBlock'])->name('admin.users.toggleBlock');
// Route::get('/admin/contact', [ContactController::class, 'index'])->name('admin.contact.index');
// Route::get('/booking/riwayat', [BookingController::class, 'riwayat'])->name('booking.riwayat');
// >>>>>>> fffb39338c68f80768a0eb6627658f0545b222cb


Route::get('/admin', function () {
    $bookings = \App\Models\Booking::with(['user', 'service'])->latest()->get();
    return view('admin.dashboard', compact('bookings'));
});

Route::put('/admin/bookings/{id}/status', [DashboardController::class, 'updateStatus'])
    ->name('admin.bookings.updateStatus');
Route::get('admin/booking/{booking}/edit', [BookingController::class, 'edit'])->name('booking.edit');
Route::get('/admin/booking/create', [BookingController::class, 'create'])->name('admin.booking.create');
Route::post('/admin/booking', [BookingController::class, 'store'])->name('admin.booking.store');
Route::post('/admin/users/{id}/toggle-block', [UserController::class, 'toggleBlock'])->name('admin.users.toggleBlock');

Route::post('/admin/contact/{id}/post-testimoni', [ContactController::class, 'postTestimoni'])->name('admin.contact.postTestimoni');
Route::post('/admin/contact/{id}/retract-testimoni', [ContactController::class, 'retractTestimoni'])->name('admin.contact.retractTestimoni');




