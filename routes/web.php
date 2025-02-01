<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

Route::resource('clients', ClientController::class);
Route::resource('payments', PaymentController::class);


