<?php

use App\Http\Controllers\AllResepController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CopyController;
use App\Http\Controllers\PembuatController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\ResepController;
use App\Http\Controllers\TagsController;
use App\Http\Middleware\Admin;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';

Route::get('/', fn() => redirect('resep'));
Route::get('/resep', [ResepController::class, 'index'])->whereNumber('per_page')->name('resep.beranda');
Route::get('/resep/{pembuat}', [PembuatController::class, 'show'])->name('resep.pembuat.view');
Route::get('/resep/{pembuat}/{id}', [ResepController::class, 'show'])->name('resep.view');
Route::get('/tags', [TagsController::class, 'index'])->name('resep.tags.view');
Route::get('/tags/{tag}', [TagsController::class, 'show'])->name('resep.tag.view');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [PembuatController::class, 'index'])->name('dashboard');
    Route::post('copy/{id}', CopyController::class)->name('copy.resep');
    Route::prefix('sharing')->name('resep.')->group(function () {
        Route::get('/tambah', [ResepController::class, 'create'])->name('tambah');
        Route::post('/tambah', [ResepController::class, 'store'])->name('simpan');
        Route::get('/{id}/edit', [ResepController::class, 'edit'])->name('edit');
        Route::put('/{id}/update', [ResepController::class, 'update'])->name('update');
        Route::delete('/{id}', [ResepController::class, 'destroy'])->name('destroy');
        Route::put('/{id}/status', [ResepController::class, 'status'])->name('status.update');
    });

    Route::post('resep/{id}/comment', [CommentController::class, 'store'])->name('comment.store');
    Route::delete('resep/{id}/comment', [CommentController::class, 'destroy'])->name('comment.delete');
    Route::put('resep/{id}/comment/update', [CommentController::class, 'update'])->name('comment.update');

    Route::post('resep/reply/{id}/  comment', [ReplyController::class, 'store'])->name('comment.reply.store');
    Route::delete('resep/reply/{id}/comment', [ReplyController::class, 'destroy'])->name('comment.reply.delete');
    Route::put('resep/reply/{id}/comment/update', [ReplyController::class, 'update'])->name('comment.reply.update');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware(Admin::class)->group(function () {
        Route::get('admin_tags', [TagsController::class, 'view'])->name('tags.view');
        Route::put('admin_tags/{id}', [TagsController::class, 'update'])->name('tags.update');
        Route::delete('admin_tags/{id}', [TagsController::class, 'destroy'])->name('tags.destroy');
        Route::post('admin_tags', [TagsController::class, 'store'])->name('tags.store');

        Route::resource('admin_users', UsersController::class);

        Route::resource('all_reseps', AllResepController::class);
    });
});
