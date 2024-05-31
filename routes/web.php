<?php

use App\Http\Controllers\BarcodeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name("base");

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/scan', [BarcodeController::class, "scan"])->name("scan");
    Route::get('/dashboard', [BarcodeController::class, "generate"])->name("dashboard");
    Route::get('/hasil/{hasil?}', [BarcodeController::class, "result"])->name("result");


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
