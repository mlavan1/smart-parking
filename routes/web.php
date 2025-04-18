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
Route::get('/search', [SlotsController::class, 'index'])->name('slots.view');

Route::post('/book-parking', [SlotsController::class, 'book'])->name('book.parking');


// Authenticated User Routes
Route::middleware('auth')->group(function () {
    // Home
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Slot Booking
});


// ====================
//     ADMIN ROUTES
// ====================

// SLOTS

Route::get('/slots', [AdminController::class, 'viewSlots'])->name('admin.all-slots');
Route::post('/store-slots', [AdminController::class, 'slotSaveOrUpdate'])->name('slots.saveOrUpdate');
Route::delete('/slots/{slot}', [AdminController::class, 'slotDelete'])->name('slots.delete');

// SECTIONS

Route::get('/sections', [AdminController::class, 'viewSections'])->name('admin.all-sections');
Route::post('/store-sections', [AdminController::class, 'sectionSaveOrUpdate'])->name('sections.saveOrUpdate');
Route::delete('/sections/{slot}', [AdminController::class, 'sectionDelete'])->name('sections.delete');

// VENDORS

Route::get('/vendors', [AdminController::class, 'viewVendors'])->name('admin.all-vendors');
Route::post('/vendors/store', [AdminController::class, 'vendorStore'])->name('vendors.store');

// VENDOR SLOTS

Route::get('/vendor-slots', [AdminController::class, 'viewVendorSlots'])->name('admin.all-vendors-slots');

// USERS

Route::get('/users', [AdminController::class, 'viewUsers'])->name('admin.all-users');

// CURRENT BOOKINGS

Route::get('/bookings-current', [AdminController::class, 'viewCurrentBooking'])->name('admin.bookings.current');
Route::post('/bookings/{id}/cancel', [AdminController::class, 'cancelBooking'])->name('bookings.cancel');
Route::post('/bookings/{id}/accept', [AdminController::class, 'acceptBooking'])->name('bookings.accept');
Route::get('/bookings/{id}/edit-date', [AdminController::class, 'editDate'])->name('bookings.editDate');
Route::post('/bookings/{id}/update-date', [AdminController::class, 'updateDate'])->name('bookings.updateDate');


// PAST BOOKING

Route::get('/bookings-past', [AdminController::class, 'viewPastBooking'])->name('admin.bookings.past');

// AUTH ROUTES
require __DIR__.'/auth.php';
