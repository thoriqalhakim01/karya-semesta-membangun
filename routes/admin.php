<?php

use App\Livewire\Admin\Blogs\CreateBlog;
use App\Livewire\Admin\Blogs\IndexBlog;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Investments\IndexInvestment;
use App\Livewire\Admin\Investments\ShowInvestment;
use App\Livewire\Admin\Members\CreateMember;
use App\Livewire\Admin\Members\EditMember;
use App\Livewire\Admin\Members\EditMemberInvestments;
use App\Livewire\Admin\Members\EditMemberPassword;
use App\Livewire\Admin\Members\EditMemberPrograms;
use App\Livewire\Admin\Members\IndexMember;
use App\Livewire\Admin\Members\ShowMember;
use App\Livewire\Admin\Programs\IndexProgram;
use App\Livewire\Admin\Programs\ShowProgram;
use App\Livewire\Admin\Transactions\CreateInvestmentTransaction;
use App\Livewire\Admin\Transactions\CreateProgramTransaction;
use App\Livewire\Admin\Transactions\EditInvestmentTransaction;
use App\Livewire\Admin\Transactions\EditProgramTransaction;
use App\Livewire\Admin\Transactions\IndexTransaction;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/', Dashboard::class)->name('admin.index');

        Route::prefix('members')->group(function () {
            Route::get('/', IndexMember::class)->name('admin.members.index');
            Route::get('/create', CreateMember::class)->name('admin.members.create');
            Route::get('/{member}', ShowMember::class)->name('admin.members.show');
            Route::get('/{member}/edit', EditMember::class)->name('admin.members.edit');
            Route::get('/{member}/edit-programs', EditMemberPrograms::class)->name('admin.members.edit-programs');
            Route::get('/{member}/edit-investments', EditMemberInvestments::class)->name('admin.members.edit-investments');
            Route::get('/{member}/edit-password', EditMemberPassword::class)->name('admin.members.edit-password');
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
            Route::get('/create-program-transaction', CreateProgramTransaction::class)->name('admin.transactions.create-program');
            Route::get('/create-investment-transaction', CreateInvestmentTransaction::class)->name('admin.transactions.create-investment');
            Route::get('/{id}/edit-investment-transactions', EditInvestmentTransaction::class)->name('admin.transactions.edit-investment-transactions');
            Route::get('/{id}/edit-program-transactions', EditProgramTransaction::class)->name('admin.transactions.edit-program-transactions');
        });

        Route::prefix('blogs')->group(function () {
            Route::get('/', IndexBlog::class)->name('admin.blogs.index');
            Route::get('/create', CreateBlog::class)->name('admin.blogs.create');
        });
    });
});
