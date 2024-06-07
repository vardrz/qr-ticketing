<?php

use App\Http\Controllers\BarcodeController;
use App\Http\Controllers\ProfileController;
use App\Models\WebConfig;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $maintenance = WebConfig::first()->maintenance;
    if ($maintenance == 'yes') {
        return redirect('https://alton.agsa.site');
    } else {
        return view('welcome');
    }
})->name("base");

Route::get('/close-this-website', function () {
    WebConfig::where('id', 1)->update(['maintenance' => 'yes']);
    return "OK - Website Closed";
})->name("close");

Route::get('/open-this-website', function () {
    WebConfig::where('id', 1)->update(['maintenance' => 'no']);
    return redirect('/');
})->name("open");

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/reset-db', function () {
        Artisan::call('migrate:fresh --seed');
        return "OK - Database Refreshed";
    })->name("migrate");

    Route::get('/scan', [BarcodeController::class, "scan"])->name("scan");
    Route::get('/dashboard', [BarcodeController::class, "generate"])->name("dashboard");
    Route::get('/verify/{hasil?}', [BarcodeController::class, "result"])->name("result");

    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
