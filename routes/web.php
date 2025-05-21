<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\AdminController;
use App\Models\Booking;

// Main page
Route::get('/', function () {
    return view('index');
})->name('home');

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Booking Routes
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');

// Contact/Testimonial Routes
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
  
    Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/', 'App\Http\Controllers\Admin\AdminController@dashboard')->name('admin.dashboard');
   
    });
});

Route::get('/control', function () {
    $bookings = Booking::with(['user', 'service'])->latest()->get();
    return view('control', compact('bookings'));
});

Route::get('/admin', function () {
    $bookings = \App\Models\Booking::with(['user', 'service'])->latest()->get();
    return view('admin.simple_admin', compact('bookings'));
});