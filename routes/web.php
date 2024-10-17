<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;

// Route::resource('articles', ArticleController::class);
Route::get('/', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/create', [ArticleController::class, 'create'])->name('articles.create');
Route::post('/store', [ArticleController::class, 'store'])->name('articles.store');
Route::post('/confirm_store', [ArticleController::class, 'confirm_store'])->name('articles.confirm_store');
Route::post('/edit/{article}', [ArticleController::class, 'edit'])->name('articles.edit');
Route::post('/update/{article}', [ArticleController::class, 'update'])->name('articles.update');
Route::post('/confirm_destroy/{article}', [ArticleController::class, 'confirm_destroy'])->name('articles.confirm_destroy');
Route::post('/destroy/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');
