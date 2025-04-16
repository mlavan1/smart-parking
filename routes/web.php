<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SlotsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookingController;


// Public Routes
Route::view('/', 'home');

Route::view('/details', 'details')->name('details');
Route::post('/pay',[BookingController::class, 'proceedToPay'])->name('book.pay');

// Authenticated User Routes
Route::middleware('auth')->group(function () {
    // Home
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Slot Booking
    Route::get('/search', [SlotsController::class, 'index'])->name('slots.view');
    Route::post('/book-parking', [SlotsController::class, 'book'])->name('book.parking');
});

// Admin Routes (can later be grouped under admin middleware if needed)
Route::get('/slots', [AdminController::class, 'viewSlots'])->name('admin.all-slots');
Route::post('/store-slots', [AdminController::class, 'saveOrUpdate'])->name('slots.saveOrUpdate');
Route::delete('/slots/{slot}', [AdminController::class, 'destroy'])->name('slots.destroy');

Route::get('/sections', [AdminController::class, 'viewSections'])->name('admin.all-sections');
Route::post('/store-sections', [AdminController::class, 'sectionSaveOrUpdate'])->name('sections.saveOrUpdate');


Route::get('/vendors', [AdminController::class, 'viewVendors'])->name('admin.all-vendors');
Route::post('/vendors/store', [AdminController::class, 'vendorStore'])->name('vendors.store');


// Auth routes (login, register, etc.)
require __DIR__.'/auth.php';
