<?php

use Illuminate\Support\Facades\Route;
use MVI\Starter\Http\Controllers\EmployeeController;
use MVI\Starter\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'home']);
Route::apiResource('/employees', EmployeeController::class);
