<?php

use App\Http\Controllers\Customer\CustomerHomeController;
use Illuminate\Support\Facades\Route;

// Mengarahkan rute langsung ke CustomerHomeController
Route::get('/dashboard', [CustomerHomeController::class, 'index'])->name('customer.dashboard');
Route::get('/home', [CustomerHomeController::class, 'index'])->name('customer.home');