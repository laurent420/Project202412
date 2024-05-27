<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\AddItemController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\BansController;
use Illuminate\Support\Facades\Route;

// Authentication routes
Route::get('/', function () {
    return view('auth/login');
});

// Dashboard route
Route::get('/dashboard', [ItemController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

// Profile routes
Route::get('/Users', [ProfileController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('Users');
Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::post('profile/update', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('profile/destroy', [ProfileController::class, 'destroy'])->name('profile.destroy');

// User ban/unban routes
Route::post('/users/{user}/ban', [BansController::class, 'ban'])->name('users.ban');
Route::post('/users/{user}/unban', [BansController::class, 'unban'])->name('users.unban');

// Item routes
Route::post('/additem', [ItemController::class, 'store'])->name('items.store');
Route::get('/additem', [AddItemController::class, 'index'])->name('additem');

// Loaned items and cart routes
Route::get('/LoanedItems', function () {
    return view('LoanedItems');
})->middleware(['auth', 'verified'])->name('LoanedItems');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/MyCart', [CartItemController::class, 'index'])->name('MyCart');
    Route::post('/cart-items', [CartItemController::class, 'store'])->name('cart-items.store');
    Route::delete('/cart-items/{cartItem}', [CartItemController::class, 'destroy'])->name('cart-items.destroy');
});

// Favorite routes
Route::post('/favourites/add', [FavoriteController::class, 'add'])->name('favourites.add');
Route::get('/favourites', [FavoriteController::class, 'index'])->name('favourites');

// Booking routes
Route::get('/api/unavailable-dates/{item}', [BookingController::class, 'getUnavailableDates'])->name('api.unavailable-dates');
Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');

// Info route
Route::get('/Info', function () {
    return view('Info');
})->middleware(['auth', 'verified'])->name('Info');

// User profile route
Route::get('/UserProfile', function () {
    return view('userProfile');
})->middleware(['auth', 'verified'])->name('userProfile');

// Calendar routes
Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar');
Route::post('/save-date', [CalendarController::class, 'saveDate'])->name('saveDate');

// Authentication routes
require __DIR__.'/auth.php';
