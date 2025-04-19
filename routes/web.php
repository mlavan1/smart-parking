<?php

use App\Http\Controllers\Admin\ActiveBookingsController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\PastBookingController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\SlotController;
use App\Http\Controllers\Admin\VendorController;
use App\Http\Controllers\Admin\VendorParkingSlotController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;

// =====================
//     PUBLIC ROUTES
// =====================

Route::get('/', [BookingController::class, 'viewLandingPage'])->name('home.view');
Route::get('/location-selection', [BookingController::class, 'viewLocationSelectionPage'])->name('locations.view');
Route::get('/auth-check', [BookingController::class, 'checkingAuthentication'])->name('auth.check');
Route::get('/slots-selection', [BookingController::class, 'viewSlotsSelectionPage'])->name('slots.view');
Route::get('/booking-info', [BookingController::class, 'viewBookingDetailsPage'])->name('booking.details');
Route::post('/proceed-payment',[BookingController::class, 'proceedToPay'])->name('book.pay');

// Authenticated User Routes
Route::middleware('auth')->group(function () {
    // Home
    Route::get('/home', [DashboardController::class, 'index'])->name('home');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});


// ====================
//     ADMIN ROUTES
// ====================

// SLOTS

Route::get('/slots', [SlotController::class, 'viewSlots'])->name('admin.all-slots');
Route::post('/store-slots', [SlotController::class, 'slotSaveOrUpdate'])->name('slots.saveOrUpdate');
Route::delete('/slots/{slot}', [SlotController::class, 'slotDelete'])->name('slots.delete');

// SECTIONS

Route::get('/sections', [SectionController::class, 'viewSections'])->name('admin.all-sections');
Route::post('/store-sections', [SectionController::class, 'sectionSaveOrUpdate'])->name('sections.saveOrUpdate');
Route::delete('/sections/{slot}', [SectionController::class, 'sectionDelete'])->name('sections.delete');

// VENDORS

Route::get('/vendors', [VendorController::class, 'viewVendors'])->name('admin.all-vendors');
Route::post('/vendors/store', [VendorController::class, 'vendorStore'])->name('vendors.store');

// VENDOR SLOTS

Route::get('/vendor-slots', [VendorParkingSlotController::class, 'viewVendorSlots'])->name('admin.all-vendors-slots');

// USERS

Route::get('/users', [CustomerController::class, 'viewUsers'])->name('admin.all-users');

// CURRENT BOOKINGS

Route::get('/bookings-current', [ActiveBookingsController::class, 'viewCurrentBooking'])->name('admin.bookings.current');
Route::post('/bookings/{id}/cancel', [ActiveBookingsController::class, 'cancelBooking'])->name('bookings.cancel');
Route::post('/bookings/{id}/accept', [ActiveBookingsController::class, 'acceptBooking'])->name('bookings.accept');
Route::get('/bookings/{id}/edit-date', [ActiveBookingsController::class, 'editDate'])->name('bookings.editDate');
Route::post('/bookings/{id}/update-date', [ActiveBookingsController::class, 'updateDate'])->name('bookings.updateDate');


// PAST BOOKING

Route::get('/bookings-past', [PastBookingController::class, 'viewPastBooking'])->name('admin.bookings.past');

// AUTH ROUTES
require __DIR__.'/auth.php';
