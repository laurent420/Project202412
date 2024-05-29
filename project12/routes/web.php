<?php

use App\Http\Controllers\{
    ItemController, 
    AddItemController, 
    FavoriteController, 
    CartItemController, 
    BookingController, 
    LoanedItemsController, 
    ProfileController, 
    CalendarController, 
    BansController
};
use Illuminate\Support\Facades\Route;

Route::get('/item/{id}', [ItemController::class, 'show'])->name('item.show');
    
// Authentication routes
Route::get('/', function () {
    return view('auth/login');
});

// Dashboard route
Route::get('/dashboard', [ItemController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');


// Profile routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/Users', [ProfileController::class, 'showUsers'])->name('Users');
    Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('profile/destroy', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// User ban/unban routes
Route::post('/users/{user}/ban', [BansController::class, 'ban'])->name('users.ban');
Route::post('/users/{user}/unban', [BansController::class, 'unban'])->name('users.unban');


Route::post('/bans/ban/{user}', [BanController::class, 'ban'])->name('bans.ban');
Route::post('/bans/unban/{user}', [BanController::class, 'unban'])->name('bans.unban');





Route::post('/additem', [ItemController::class, 'store'])->name('items.store');
Route::get('/additem', [AddItemController::class, 'index'])->name('additem');


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/LoanedItems', [LoanedItemsController::class, 'index'])->name('LoanedItems');
    // Other routes...
});
// Item routes
Route::post('/additem', [ItemController::class, 'store'])->name('items.store');
Route::get('/additem', [AddItemController::class, 'index'])->name('additem');
// Loaned items and cart routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/LoanedItems', [LoanedItemsController::class, 'index'])->name('LoanedItems');
    // Other routes...
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/users/{user}/ban', [BansController::class, 'ban'])->name('users.ban');
    Route::post('/users/{user}/unban', [BansController::class, 'unban'])->name('users.unban');
});

// Loaned items route
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/loaned-items', [LoanedItemsController::class, 'index'])->name('loaned-items');
});

// Item routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/additem', [ItemController::class, 'store'])->name('items.store');
    Route::get('/additem', [AddItemController::class, 'index'])->name('additem');
});

// Cart routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/MyCart', [CartItemController::class, 'index'])->name('MyCart');
    Route::post('/cart-items', [CartItemController::class, 'store'])->name('cart-items.store');
    Route::delete('/cart-items/{cartItem}', [CartItemController::class, 'destroy'])->name('cart-items.destroy');
});

// Favorite routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/favourites/add', [FavoriteController::class, 'add'])->name('favourites.add');
    Route::get('/favourites', [FavoriteController::class, 'index'])->name('favourites');
    Route::delete('/favourites/{favorite}', [FavoriteController::class, 'remove'])->name('favourites.remove');
});

// Booking routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/api/unavailable-dates/{item}', [BookingController::class, 'getUnavailableDates'])->name('api.unavailable-dates');
});

// Info route
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/Info', function () {
        return view('Info');
    })->name('Info');
});

// User profile route
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/UserProfile', function () {
        return view('userProfile');
    })->name('userProfile');
});

// Calendar routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar');
    Route::post('/save-date', [CalendarController::class, 'saveDate'])->name('saveDate');
Route::get('/search', 'SearchController@search')->name('search');
Route::post('/user-agreement', 'RegistrationController@handleUserAgreement')->name('user.agreement');

});

Route::delete('/items/{item}', [ItemController::class, 'destroy'])->middleware(['auth', 'verified'])->name('items.destroy');



Route::post('/users/{user}/returned', [RegisteredUserController::class, 'returned'])->name('users.returned');

require __DIR__.'/auth.php';
