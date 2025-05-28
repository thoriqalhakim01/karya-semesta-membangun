<?php

use App\Livewire\User\Dashboard;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');

    // User Routes
    Route::middleware(['auth'])->group(function () {
        Route::get('/dashboard', Dashboard::class)->name('user.index');
    });
});

require __DIR__ . '/admin.php';
require __DIR__ . '/auth.php';
