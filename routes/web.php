<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomePageController;

Route::get('/', [WelcomePageController::class, 'index'])->name('welcome');
Route::get('/gallery', [WelcomePageController::class, 'gallery'])->name('gallery');
