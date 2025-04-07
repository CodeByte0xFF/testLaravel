<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::get('/posts/{categorySlug}', [CategoryController::class, 'index'])->name('category.index');
Route::get('/posts/{categorySlug}/{postSlug}', [PostController::class, 'index'])->name('post.index');

Route::get('/contacts', [ContactController::class, 'index']);
