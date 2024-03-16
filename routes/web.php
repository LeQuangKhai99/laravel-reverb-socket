<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Laravel\Pulse\Facades\Pulse;

Route::get('/', function () {
    Pulse::handleExceptionsUsing(function ($e) {
        Log::debug('An exception happened in Pulse', [
            'message' => $e->getMessage(),
            'stack' => $e->getTraceAsString(),
        ]);
    });
    return view('welcome');
});
Route::get('/send', function () {
    $mess = request('mess');
    event(new App\Events\Message($mess));
    return view('send');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
