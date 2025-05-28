<?php

use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Investments\IndexInvestment;
use App\Livewire\Admin\Investments\ShowInvestment;
use App\Livewire\Admin\Members\CreateMember;
use App\Livewire\Admin\Members\EditMember;
use App\Livewire\Admin\Members\IndexMember;
use App\Livewire\Admin\Members\ShowMember;
use App\Livewire\Admin\Programs\IndexProgram;
use App\Livewire\Admin\Programs\ShowProgram;
use App\Livewire\Admin\Transactions\IndexTransaction;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/', Dashboard::class)->name('admin.index');
    });

    Route::prefix('members')->group(function () {
        Route::get('/', IndexMember::class)->name('admin.members.index');
        Route::get('/create', CreateMember::class)->name('admin.members.create');
        Route::get('/{member}', ShowMember::class)->name('admin.members.show');
        Route::get('/{member}/edit', EditMember::class)->name('admin.members.edit');
    });

    Route::prefix('programs')->group(function () {
        Route::get('/', IndexProgram::class)->name('admin.programs.index');
        Route::get('/{program}', ShowProgram::class)->name('admin.programs.show');
    });

    Route::prefix('investments')->group(function () {
        Route::get('/', IndexInvestment::class)->name('admin.investments.index');
        Route::get('/{investment}', ShowInvestment::class)->name('admin.investments.show');
    });

    Route::prefix('transactions')->group(function () {
        Route::get('/', IndexTransaction::class)->name('admin.transactions.index');
    });
});
