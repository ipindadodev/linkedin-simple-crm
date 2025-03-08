<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\SetLocale;
use Livewire\Volt\Volt;

// Importación correcta de componentes Livewire
use App\Livewire\ProspectStatuses\ProspectStatusesIndex;
use App\Livewire\Prospects\ProspectsIndex;
use App\Livewire\Sequences\SequencesIndex;
use App\Livewire\SequencePoints\SequencePointsIndex;

use App\Livewire\Prospects\Create as ProspectCreate;
use App\Livewire\Prospects\Edit as ProspectEdit;
use App\Livewire\ProspectStatuses\Create as ProspectStatusCreate;
use App\Livewire\ProspectStatuses\Edit as ProspectStatusEdit;

use App\Livewire\Sequences\Create as SequenceCreate;
use App\Livewire\Sequences\Edit as SequenceEdit;

use App\Livewire\SequencePoints\Create as SequencePointCreate;
use App\Livewire\SequencePoints\Edit as SequencePointEdit;

// Página de bienvenida
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Dashboard protegido por autenticación
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Grupo de rutas de ajustes (Volt)
Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

// Grupo de rutas protegidas por autenticación
Route::middleware(['auth'])->group(function () {

    // Prospects CRUD
    Route::get('/prospects', ProspectsIndex::class)->name('prospects.index');
    Route::get('/prospects/create', ProspectCreate::class)->name('prospects.create');
    Route::get('/prospects/edit/{id}', ProspectEdit::class)->name('prospects.edit');

    // Prospect Status CRUD
    Route::get('/prospect-statuses', ProspectStatusesIndex::class)->name('prospect-statuses.index');
    Route::get('/prospect-statuses/create', ProspectStatusCreate::class)->name('prospect-statuses.create');
    Route::get('/prospect-statuses/edit/{status}', ProspectStatusEdit::class)->name('prospect-statuses.edit');

    // Sequences CRUD
    Route::get('/sequences', SequencesIndex::class)->name('sequences.index');
    Route::get('/sequences/create', SequenceCreate::class)->name('sequences.create');
    Route::get('/sequences/edit/{id}', SequenceEdit::class)->name('sequences.edit');

    // Sequence Points CRUD
    Route::get('/sequence-points', SequencePointsIndex::class)->name('sequence-points.index');
    Route::get('/sequence-points/create', SequencePointCreate::class)->name('sequence-points.create');
    Route::get('/sequence-points/edit/{id}', SequencePointEdit::class)->name('sequence-points.edit');
});

// Autenticación
require __DIR__.'/auth.php';