<?php
use App\Http\Controllers\ItemController;
use App\Http\Controllers\AddItemController;

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalendarController;


Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', [ItemController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/Users', [ProfileController::class, 'dasboard'])->middleware(['auth', 'verified'])->name('Users');
Route::post('/users/{user}/ban', 'App\Http\Controllers\ProfileController@ban')->middleware(['auth', 'verified'])->name('users.ban');
Route::post('/users/{user}/unban', 'App\Http\Controllers\ProfileController@unban')->middleware(['auth', 'verified'])->name('users.unban');



Route::post('/additem', [ItemController::class, 'store'])->name('items.store');
Route::get('/additem', [AddItemController::class, 'index'])->name('additem');


Route::get('/LoanedItems', function () {
    return view('LoanedItems');
})->middleware(['auth', 'verified'])->name('LoanedItems');

Route::get('/MyCart', function () {
    return view('MyCart');
})->middleware(['auth', 'verified'])->name('MyCart');

Route::get('/Favourites', function () {
    return view('Favourites');
})->middleware(['auth', 'verified'])->name('Favourites');

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

require __DIR__.'/auth.php';
