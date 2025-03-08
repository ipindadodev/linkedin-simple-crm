<?php

use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use Livewire\Volt\Volt;

// Importar componentes de Livewire
use App\Http\Livewire\Prospects\Index as ProspectIndex;
use App\Http\Livewire\Prospects\Create as ProspectCreate;
use App\Http\Livewire\Prospects\Edit as ProspectEdit;

use App\Http\Livewire\ProspectStatuses\Index as ProspectStatusIndex;
use App\Http\Livewire\ProspectStatuses\Create as ProspectStatusCreate;
use App\Http\Livewire\ProspectStatuses\Edit as ProspectStatusEdit;

use App\Http\Livewire\Sequences\Index as SequenceIndex;
use App\Http\Livewire\Sequences\Create as SequenceCreate;
use App\Http\Livewire\Sequences\Edit as SequenceEdit;
use App\Http\Livewire\Sequences\Show as SequenceShow;

use App\Http\Livewire\Sequences\SequencePoints\Index as SequencePointIndex;
use App\Http\Livewire\Sequences\SequencePoints\Create as SequencePointCreate;
use App\Http\Livewire\Sequences\SequencePoints\Edit as SequencePointEdit;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

// 📌 Prospects CRUD
Route::middleware(['auth'])->prefix('prospects')->name('prospects.')->group(function () {
    Route::get('/', Livewire::mount(ProspectIndex::class))->name('index');
    Route::get('/create', Livewire::mount(ProspectCreate::class))->name('create');
    Route::get('/edit/{id}', Livewire::mount(ProspectEdit::class))->name('edit');
});

// 📌 Prospect Statuses CRUD
Route::middleware(['auth'])->prefix('prospect-statuses')->name('prospect-statuses.')->group(function () {
    Route::get('/', Livewire::mount(ProspectStatusIndex::class))->name('index');
    Route::get('/create', Livewire::mount(ProspectStatusCreate::class))->name('create');
    Route::get('/edit/{id}', Livewire::mount(ProspectStatusEdit::class))->name('edit');
});

// 📌 Sequences CRUD
Route::middleware(['auth'])->prefix('sequences')->name('sequences.')->group(function () {
    Route::get('/', Livewire::mount(SequenceIndex::class))->name('index');
    Route::get('/create', Livewire::mount(SequenceCreate::class))->name('create');
    Route::get('/edit/{id}', Livewire::mount(SequenceEdit::class))->name('edit');
    Route::get('/show/{id}', Livewire::mount(SequenceShow::class))->name('show');
});

// 📌 Sequence Points CRUD (Nested inside sequences)
Route::middleware(['auth'])->prefix('sequences/{sequence}/points')->name('sequences.points.')->group(function () {
    Route::get('/', Livewire::mount(SequencePointIndex::class))->name('index');
    Route::get('/create', Livewire::mount(SequencePointCreate::class))->name('create');
    Route::get('/edit/{id}', Livewire::mount(SequencePointEdit::class))->name('edit');
});
