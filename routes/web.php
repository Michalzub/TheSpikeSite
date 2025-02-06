<?php

use App\Http\Controllers\ForumController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\SpikeSiteController;

Route::redirect('/dashboard', '/');

Route::middleware(['auth'])->group( function () {
    Route::get('/discussion/create',[ForumController::class, 'create'])->name('discussion.create');
    Route::get('/discussion/{discussion}/edit',[ForumController::class, 'edit'])->name('discussion.edit');
    Route::post('/discussion', [ForumController::class, 'store'])->name('discussion.store');
    Route::put('/discussion/{discussion}', [ForumController::class, 'update'])->name('discussion.update');
    Route::delete('/discussion/{discussion}', [ForumController::class, 'destroy'])->name('discussion.destroy');
    Route::post('/discussions/{discussion}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::post('/vote', [ForumController::class, 'vote'])->name('forum.vote');
});
Route::get('/', [SpikeSiteController::class, 'index'])->name('wiki.index');
Route::get('/agents', [SpikeSiteController::class, 'agents'])->name('wiki.agents');
Route::get('/agents/{name}', [SpikeSiteController::class, 'agentDetails'])->name('wiki.agent.details');
Route::get('/maps', [SpikeSiteController::class, 'maps'])->name('wiki.maps');
Route::get('/maps/{name}', [SpikeSiteController::class, 'mapDetails'])->name('wiki.maps.details');
Route::get('/weapons', [SpikeSiteController::class, 'weapons'])->name('wiki.weapons');
Route::get('/weapons/{name}', [SpikeSiteController::class, 'weaponDetails'])->name('wiki.weapon.details');

Route::get('/forum', [ForumController::class, 'index'])->name('forum.index');
Route::get('/discussion/{discussion}', [ForumController::class, 'show'])->name('discussion.show');
Route::get('/comments/{comment}/load-replies', [CommentController::class, 'loadReplies'])->name('comments.loadReplies');
Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('profile.show');


Route::middleware('auth')->group(function () {

    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/favorite/{uuid}/{type}', [ProfileController::class, 'updateFavorite'])->name('favorite.update');
});

require __DIR__.'/auth.php';
