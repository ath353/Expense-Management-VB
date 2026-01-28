<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
    
    Route::get('categories', \App\Livewire\Categories\Index::class)->name('categories.index');
    Route::get('categories/create', \App\Livewire\Categories\Create::class)->name('categories.create');
    Route::get('categories/{category}/edit', \App\Livewire\Categories\Edit::class)->name('categories.edit');

    Route::get('expenses', \App\Livewire\Expenses\Index::class)->name('expenses.index');
    Route::get('expenses/create', \App\Livewire\Expenses\Create::class)->name('expenses.create');
    Route::get('expenses/{expense}/edit', \App\Livewire\Expenses\Edit::class)->name('expenses.edit');
});

require __DIR__.'/settings.php';
