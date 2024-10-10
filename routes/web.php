<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;

// Route::resource('articles', ArticleController::class);
Route::get('/', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/create', [ArticleController::class, 'create'])->name('articles.create');
Route::post('/store', [ArticleController::class, 'store'])->name('articles.store');
Route::post('/confirm_store', [ArticleController::class, 'confirm_store'])->name('articles.confirm_store');
Route::post('/edit/{id}', [ArticleController::class, 'edit'])->name('articles.edit');
Route::post('/update/{id}', [ArticleController::class, 'update'])->name('articles.update');
Route::post('/confirm_destroy/{id}', [ArticleController::class, 'confirm_destroy'])->name('articles.confirm_destroy');
Route::post('/destroy/{id}', [ArticleController::class, 'destroy'])->name('articles.destroy');
