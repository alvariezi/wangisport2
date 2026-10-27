<?php

use App\Models\Tenant;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function (Tenant $tenant) {
    return view('tenant.dashboard', ['tenant' => $tenant]);
})->name('dashboard');
