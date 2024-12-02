<?php

use App\Http\Controllers\ForumController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\SpikeSiteController;

Route::redirect('/', '/wiki')->name('dashboard');

Route::middleware(['auth', 'verified'])->group( function () {
    /*
    Route::get('/note', [NoteController::class, 'index'])->name('note.index');
    Route::get('/note/create', [NoteController::class, 'create'])->name('note.create');
    Route::post('/note', [NoteController::class, 'store'])->name('note.store');
    Route::get('/note/{note}', [NoteController::class, 'show'])->name('note.show');
    Route::get('/note/{note}/edit', [NoteController::class, 'edit'])->name('note.edit');
    Route::post('/note/{note}', [NoteController::class, 'update'])->name('note.update');
    Route::delete('/note/{note}', [NoteController::class, 'destroy'])->name('note.destroy');
    */
    //Route::resource('note', NoteController::class);


});
Route::get('/', [SpikeSiteController::class, 'index'])->name('wiki.index');
Route::get('/agents', [SpikeSiteController::class, 'agents'])->name('wiki.agents');
Route::get('/maps', [SpikeSiteController::class, 'maps'])->name('wiki.maps');
Route::get('/weapons', [SpikeSiteController::class, 'weapons'])->name('wiki.weapons');

Route::get('/forum', [ForumController::class, 'index'])->name('forum.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
