<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function (string $venue) {
    return view('customer.home', ['venue' => $venue]);
})->name('home');

Route::get('/courts/{court}', function (string $venue, string $court) {
    return view('customer.courts.show', ['venue' => $venue, 'court' => $court]);
})->name('courts.show');
