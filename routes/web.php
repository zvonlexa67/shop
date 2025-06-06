<?php

// use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

Route::get('/', [IndexController::class, 'index'])->name('index');
Route::get('/category/{slug}', [CategoryController::class, 'index'])->name('category');

Route::get('/welcome', action: fn() => Inertia::render('Welcome'))->name('welcome');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
require __DIR__.'/dashboard.php';
