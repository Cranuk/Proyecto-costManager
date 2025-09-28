<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\RevenueController;
use Illuminate\Support\Facades\Route;

// TODO: Acordarse que los names son mas para ser usados en los href para no poner la ruta completa de la misma

// NOTE: Rutas para helper
Route::get('/', [Controller::class, 'index'])->name('index');

// NOTE: Rutas para categorias
Route::controller(CategoryController::class)->group(function () {
    Route::get('/categories/index', 'index')->name('category');
    Route::get('/categories/create', 'create')->name('categoryCreate');
    Route::get('/categories/edit/{id}', 'edit')->name('categoryEdit');
    Route::delete('/categories/delete/{id}', 'delete')->name('categoryDelete');
    Route::post('/categories/update', 'update')->name('categoryUpdate');
    Route::post('/categories/save', 'save')->name('categorySave');
});

// NOTE: Rutas para gastos
Route::controller(ExpenseController::class)->group(function () {
    Route::get('/expenses/index', 'index')->name('expense');
    Route::get('/expenses/create', 'create')->name('expenseCreate');
    Route::get('/expenses/edit/{id}', 'edit')->name('expenseEdit');
    Route::delete('/expenses/delete/{id}', 'delete')->name('expenseDelete');
    Route::post('/expenses/update', 'update')->name('expenseUpdate');
    Route::post('/expenses/save', 'save')->name('expenseSave');
});

// NOTE: Rutas para ingresos
Route::controller(RevenueController::class)->group(function () {
    Route::get('/revenues/index', 'index')->name('revenue');
    Route::get('/revenues/create', 'create')->name('revenueCreate');
    Route::get('/revenues/edit/{id}', 'edit')->name('revenueEdit');
    Route::delete('/revenues/delete/{id}', 'delete')->name('revenueDelete');
    Route::post('/revenues/update', 'update')->name('revenueUpdate');
    Route::post('/revenues/save', 'save')->name('revenueSave');
});

// NOTE: Rutas para filtros
Route::controller(FilterController::class)->group(function () {
    Route::get('/filters/date', 'date')->name('obtainDate');
    Route::post('/filters/table','filter')->name('filterDate');
});

// NOTE: Rutas para historial
Route::controller(RecordController::class)->group(function () {
    Route::get('/records/index', 'index')->name('record');
    Route::get('/records/pdf/{id}', 'generatePdf')->name('generatePdf');
});