<?php

use App\Http\Controllers\ForumController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\SpikeSiteController;

Route::redirect('/dashboard', '/');

Route::middleware(['auth', 'verified'])->group( function () {
    Route::get('/discussion/create',[ForumController::class, 'create'])->name('discussion.create');
    Route::get('/discussion/{discussion}/edit',[ForumController::class, 'edit'])->name('discussion.edit');
    Route::post('/discussion', [ForumController::class, 'store'])->name('discussion.store');
    Route::put('/discussion/{discussion}', [ForumController::class, 'update'])->name('discussion.update');
    Route::delete('/discussion/{discussion}', [ForumController::class, 'destroy'])->name('discussion.destroy');

    Route::post('/vote', [ForumController::class, 'vote'])->name('forum.vote');
});
Route::get('/', [SpikeSiteController::class, 'index'])->name('wiki.index');
Route::get('/agents', [SpikeSiteController::class, 'agents'])->name('wiki.agents');
Route::get('/maps', [SpikeSiteController::class, 'maps'])->name('wiki.maps');
Route::get('/weapons', [SpikeSiteController::class, 'weapons'])->name('wiki.weapons');

Route::get('/forum', [ForumController::class, 'index'])->name('forum.index');
Route::get('/discussion/{discussion}', [ForumController::class, 'show'])->name('discussion.show');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
