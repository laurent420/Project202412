<?php
use App\Http\Controllers\ItemController;
use App\Http\Controllers\AddItemController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\CartItemController;



use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalendarController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard', [ItemController::class, 'index'])->name('dashboard');




Route::post('/additem', [ItemController::class, 'store'])->name('items.store');
Route::get('/additem', [AddItemController::class, 'index'])->name('additem');


Route::get('/LoanedItems', function () {
    return view('LoanedItems');
})->middleware(['auth', 'verified'])->name('LoanedItems');

Route::get('/MyCart', function () {
    return view('MyCart');
})->middleware(['auth', 'verified'])->name('MyCart');
Route::post('/cart-items', [CartItemController::class, 'store'])->name('cart-items.store');
Route::delete('/cart-items/{cartItem}', [CartItemController::class, 'destroy'])->name('cart-items.destroy');
Route::get('/mycart', [CartItemController::class, 'index'])->name('mycart');

Route::post('/favourites/add', [FavoriteController::class, 'add'])->name('favourites.add');
Route::get('/favourites', [FavoriteController::class, 'index'])->name('favourites');



Route::get('/Info', function () {
    return view('Info');
})->middleware(['auth', 'verified'])->name('Info');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/calender', [CalendarController::class, 'index'])->name('calender');
Route::post('/save-date', [CalendarController::class, 'saveDate'])->name('saveDate');

require __DIR__.'/auth.php';
