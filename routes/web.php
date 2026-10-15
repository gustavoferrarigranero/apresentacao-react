<?php

use App\Http\Controllers\AppointmentController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/agenda');
Route::get('/agenda', [AppointmentController::class, 'index'])->name('appointments.index');
Route::post('/agenda', [AppointmentController::class, 'store'])->name('appointments.store');
