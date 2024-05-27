<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\AddItemController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\LoanedItemsController;





use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\SearchController;

Route::get('profile', 'ProfileController@show')->name('profile');


Route::get('/user/{id}', 'UserController@show')->name('user.profile');




Route::get('/', function () {
    return view('auth/login');
});


Route::get('/dashboard', [ItemController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/Users', [ProfileController::class, 'dasboard'])->middleware(['auth', 'verified'])->name('Users');
Route::post('/users/{user}/ban', [BansController::class, 'ban'])->name('users.ban');
Route::post('/users/{user}/unban', [BansController::class, 'unban'])->name('users.unban');


Route::get('/loaned-items', [LoanedItemsController::class, 'index'])->middleware(['auth', 'verified'])->name('loaned-items');



Route::post('/additem', [ItemController::class, 'store'])->name('items.store');
Route::get('/additem', [AddItemController::class, 'index'])->name('additem');


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/LoanedItems', [LoanedItemsController::class, 'index'])->name('LoanedItems');
    // Other routes...
});

Route::get('/MyCart', function () {
    return view('MyCart');
})->middleware(['auth', 'verified'])->name('MyCart');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/MyCart', [CartItemController::class, 'index'])->name('MyCart');
    Route::post('/cart-items', [CartItemController::class, 'store'])->name('cart-items.store');
    Route::delete('/cart-items/{cartItem}', [CartItemController::class, 'destroy'])->name('cart-items.destroy');
});

Route::post('/favourites/add', [FavoriteController::class, 'add'])->name('favourites.add');
Route::get('/favourites', [FavoriteController::class, 'index'])->name('favourites');
Route::delete('/favourites/{favorite}', [FavoriteController::class, 'remove'])->name('favourites.remove');


Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');

// API route to fetch unavailable dates
Route::get('/api/unavailable-dates/{item}', function ($item) {
    $item = App\Models\Item::find($item);
    return response()->json([
        'dates' => $item->bookings->pluck('start_date')->merge($item->bookings->pluck('end_date'))->toArray()
    ]);
})->name('api.unavailable-dates');



Route::get('/Info', function () {
    return view('Info');
})->middleware(['auth', 'verified'])->name('Info');

Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::post('profile/update', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('profile/destroy', [ProfileController::class, 'destroy'])->name('profile.destroy');

// Route to display users
Route::get('/Users', [ProfileController::class, 'showUsers'])->middleware(['auth', 'verified'])->name('Users');

Route::get('/UserProfile', function () {
    return view('userProfile');
})->middleware(['auth', 'verified'])->name('userProfile');


Route::get('/calender', [CalendarController::class, 'index'])->name('calender');
Route::post('/save-date', [CalendarController::class, 'saveDate'])->name('saveDate');

Route::get('/search', [SearchController::class, 'index'])->name('search');

require __DIR__.'/auth.php';
