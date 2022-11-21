<?php

use App\Http\Controllers\Companies\CompaniesController;
use App\Http\Controllers\Employees\EmployeesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// public routes
Route::get('/', [CompaniesController::class, 'index'])
    ->name('start');

// companies.index
Route::get('/', [CompaniesController::class, 'index'])
    ->name('companies.index');

// employees.index
Route::get('list', [EmployeesController::class, 'index'])
    ->name('employees.index');


// auth routes
Route::middleware('auth')->group(function () {
    // companies resource routes
    Route::resource('companies', CompaniesController::class)->except(['index'])->parameters([
        'companies' => 'company_id'
    ]);

    // employees resource routes
    Route::resource('employees', EmployeesController::class)->except(['index'])->parameters([
        'employees' => 'employee_id'
    ]);
});

require __DIR__ . '/auth.php';
