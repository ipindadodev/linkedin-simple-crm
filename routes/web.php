<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\SetLocale;
use Livewire\Volt\Volt;

use App\Livewire\Prospects\Index as ProspectIndex;
use App\Livewire\Prospects\Create as ProspectCreate;
use App\Livewire\Prospects\Edit as ProspectEdit;

use App\Livewire\ProspectStatuses\Index as ProspectStatusIndex;
use App\Livewire\ProspectStatuses\Create as ProspectStatusCreate;
use App\Livewire\ProspectStatuses\Edit as ProspectStatusEdit;

use App\Livewire\Sequences\Index as SequenceIndex;
use App\Livewire\Sequences\Create as SequenceCreate;
use App\Livewire\Sequences\Edit as SequenceEdit;

use App\Livewire\SequencePoints\Index as SequencePointIndex;
use App\Livewire\SequencePoints\Create as SequencePointCreate;
use App\Livewire\SequencePoints\Edit as SequencePointEdit;

// Dashboard protegido por autenticación
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

    Route::get('/', function () {
    return view('welcome');
})->name('home');

// Grupo de rutas de ajustes (Volt)
Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});


Route::middleware(['auth'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');

    // Prospects CRUD
    Route::get('/prospects', ProspectIndex::class)->name('prospects.index');
    Route::get('/prospects/create', ProspectCreate::class)->name('prospects.create');
    Route::get('/prospects/edit/{id}', ProspectEdit::class)->name('prospects.edit');

    // Prospect Status CRUD
    Route::get('/prospect-statuses', ProspectStatusIndex::class)->name('prospect-statuses.index');
    Route::get('/prospect-statuses/create', ProspectStatusCreate::class)->name('prospect-statuses.create');
    Route::get('/prospect-statuses/edit/{id}', ProspectStatusEdit::class)->name('prospect-statuses.edit');

    // Sequences CRUD
    Route::get('/sequences', SequenceIndex::class)->name('sequences.index');
    Route::get('/sequences/create', SequenceCreate::class)->name('sequences.create');
    Route::get('/sequences/edit/{id}', SequenceEdit::class)->name('sequences.edit');

    // Sequence Points CRUD
    Route::get('/sequence-points', SequencePointIndex::class)->name('sequence-points.index');
    Route::get('/sequence-points/create', SequencePointCreate::class)->name('sequence-points.create');
    Route::get('/sequence-points/edit/{id}', SequencePointEdit::class)->name('sequence-points.edit');
});


// Autenticación
require __DIR__.'/auth.php';