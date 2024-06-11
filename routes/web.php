<?php

use App\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::get('/', Controllers\LandingController::class)->name('landing-page');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('modul', Controllers\ModulController::class);

Route::get('modul/download/{id}', [Controllers\ModulController::class, 'download'])->name('modul.download');
Route::get('modul', [Controllers\ModulController::class, 'index'])->name('modul.index');
Route::get('modul/{modul:id}', [Controllers\ModulController::class, 'show'])->name('modul.show');

Route::middleware('auth')->group(function () {
    // Route::middleware('verified')->group(function () {

    // });
    Route::get('/profile', [Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/bookmarks/{id}', [Controllers\BookmarkController::class, 'showByUser'])->name('bookmark.showByUser');
    Route::post('bookmark', [Controllers\BookmarkController::class, 'store'])->name('bookmark.store');
    Route::delete('bookmark', [Controllers\BookmarkController::class, 'destroy'])->name('bookmark.destroy');
});

require __DIR__ . '/auth.php';
