<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomePageController;

Route::get('/', [WelcomePageController::class, 'index'])->name('welcome');
