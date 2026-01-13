<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\LiveCallController;
use App\Http\Controllers\MentorSlotController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'index'])->name('pages.index');
Route::get('/courses', [PageController::class, 'index'])->name('courses.index');
Route::get('/courses/show/{id}', [PageController::class, 'show'])->name('courses.show');
Route::middleware('auth')->group(function () {
    // Cart & Payments
    Route::post('/cart/add/{course}', [PaymentController::class, 'addToCart']);
    Route::get('/cart', [PaymentController::class, 'cart']);
    Route::post('/checkout', [PaymentController::class, 'checkout']);
    // Enrollments
    Route::get('/my-courses', [EnrollmentController::class, 'index']);
    //=============
    Route::get('/live-calls', [LiveCallController::class, 'index'])->name('live.calls');
    Route::post('/live/free/{mentor}', [LiveCallController::class, 'startFreeCall'])->name('live.free');
    Route::get('/live/room/{call}', [LiveCallController::class, 'room'])->name('live.calls.room');
    Route::post('/live/room/{call}/end', [LiveCallController::class, 'end'])->name('live.calls.end');
    Route::post('/live/join/{lesson}', [LiveCallController::class, 'joinLesson'])->name('live.calls.join');
    Route::get('/trial-lessons', [LiveCallController::class, 'trialLessons'])->name('trial.lessons');
    Route::get('/my-lessons', [LiveCallController::class, 'myLessons'])->name('my.lessons');
    // Live Calls  
    Route::get('/call-history', [LiveCallController::class, 'callHistory'])->name('call.history');
    Route::post('/live/room/{call}/tick', [LiveCallController::class, 'tick']);

    Route::get('/mentor/slots', [MentorSlotController::class, 'index']);
    Route::post('/mentor/slots', [MentorSlotController::class, 'store']);
    Route::delete('/mentor/slots/{slot}', [MentorSlotController::class, 'destroy']);
});
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
});

Route::middleware('auth')->group(function () {  
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
