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
    BansController,
    CartController,
};
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MyBagController;
use App\Http\Controllers\FavouritesController;
use App\Http\Controllers\UserController;

// Authentication routes
Route::get('/', function () {
    return view('auth/login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/my-bag', [MyBagController::class, 'index'])->name('my-bag');
    Route::get('/favourites', [FavouritesController::class, 'index'])->name('favourites');
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::get('/info', function () {
        return view('info');
    })->name('info');
});


// Andere routes...

Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/dashboard/{id}/remove', [ItemController::class, 'remove'])->name('dashboard.remove');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/LoanedItems', [ItemController::class, 'loandedItemsAdmin'])->name('LoanedItems');
});



Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/users/{user}/ban', [BansController::class, 'ban'])->name('users.ban');
    Route::post('/users/{user}/unban', [BansController::class, 'unban'])->name('users.unban');
});

// Profile routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/Users', [ProfileController::class, 'showUsers'])->name('Users');
    Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('profile/destroy', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Item routes
Route::post('/additem', [ItemController::class, 'store'])->name('items.store');
Route::get('/additem', [AddItemController::class, 'index'])->name('additem');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/users/{user}/ban', [BansController::class, 'ban'])->name('users.ban');
    Route::post('/users/{user}/unban', [BansController::class, 'unban'])->name('users.unban');
});

// Loaned items route
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/loaned-items', [LoanedItemsController::class, 'index'])->name('loaned-items');
});

// Cart routes
// Route::middleware(['auth', 'verified'])->group(function () {
//     Route::get('/MyCart', [CartItemController::class, 'index'])->name('MyCart');
//     Route::post('/cart-items', [CartItemController::class, 'store'])->name('cart-items.store');
//     Route::delete('/cart-items/{cartItem}', [CartItemController::class, 'destroy'])->name('cart-items.destroy');
// });

Route::middleware(['auth'])->group(function () {
    Route::get('/MyCart', [CartController::class, 'index'])->name('MyCart');
    Route::post('/MyCart-items/store', [CartController::class, 'store'])->name('cart-items.store');
    Route::delete('/MyCart-items/{id}', [CartController::class, 'remove'])->name('cart-items.remove');
    Route::post('/cart-items/lend', [CartController::class, 'lend'])->name('cart-items.lend');
});

// Favorite routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/favourites/add', [FavoriteController::class, 'add'])->name('favourites.add');
    Route::get('/favourites', [FavoriteController::class, 'index'])->name('favourites');
    Route::delete('/favourites/{favorite}', [FavoriteController::class, 'destroy'])->name('favourites.remove');
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
Route::get('/search', [ItemController::class,'index'])->name('search');
Route::get('/searchLoanedItems', [ItemController::class,'loandedItemsAdmin'])->name('searchLoanedItems');

Route::post('/user-agreement', 'RegistrationController@handleUserAgreement')->name('user.agreement');

});

require __DIR__.'/auth.php';
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');

// Route voor het dashboard
Route::get('/dashboard', [ItemController::class, 'index'])->name('dashboard');

// Route voor het toevoegen van een item
Route::get('/additem', function() {
    return view('additem'); // Verwijs naar je additem view
})->name('additem');

// Route voor het opslaan van een nieuw item
Route::post('/items', [ItemController::class, 'store'])->name('items.store');

// Route voor het tonen van item details
Route::get('/items/{id}', [ItemController::class, 'show'])->name('item.show');

// Route voor het toevoegen aan de winkelwagen
Route::post('/cart-items', [ItemController::class, 'addToCart'])->name('cart-items.store');

// Route voor het toevoegen aan favorieten
Route::post('/favourites', [ItemController::class, 'addToFavorite'])->name('favourites.add');

// Andere routes...

Route::post('/logout', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');
