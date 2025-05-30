<?php

use App\Livewire\User\Dashboard;
use App\Livewire\User\Investments\IndexInvestment;
use App\Livewire\User\Investments\ShowInvestment;
use App\Livewire\User\Programs\IndexProgram;
use App\Livewire\User\Programs\ShowProgram;
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
    Route::middleware(['auth', 'role:user'])->group(function () {
        Route::prefix('/dashboard')->group(function () {
            Route::get('/', Dashboard::class)->name('user.index');

            // Program routes
            Route::prefix('programs')->group(function () {
                Route::get('/', IndexProgram::class)->name('user.programs.index');
                Route::get('/{program}', ShowProgram::class)->name('user.programs.show');
            });

            // Investment routes
            Route::prefix('investments')->group(function () {
                Route::get('/', IndexInvestment::class)->name('user.investments.index');
                Route::get('/{investment}', ShowInvestment::class)->name('user.investments.show');
            });
        });

    });
});

require __DIR__ . '/admin.php';
require __DIR__ . '/auth.php';
