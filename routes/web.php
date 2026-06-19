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
Route::prefix('category')
    ->name('categories.')
    ->controller(CategoryController::class)
    ->group(function () {
        Route::get('index', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::delete('delete/{id}', 'delete')->name('delete');
        Route::post('save', 'save')->name('save');
        Route::post('update', 'update')->name('update');
    });

// NOTE: Rutas para gastos
Route::prefix('expense')
    ->name('expenses.')
    ->controller(ExpenseController::class)
    ->group(function () {
        Route::get('index', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::delete('delete/{id}', 'delete')->name('delete');
        Route::post('save', 'save')->name('save');
        Route::post('update', 'update')->name('update');
    });

// NOTE: Rutas para ingresos
Route::prefix('revenue')
    ->name('revenues.')
    ->controller(RevenueController::class)
    ->group(function () {
        Route::get('index', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::delete('delete/{id}', 'delete')->name('delete');
        Route::post('save', 'save')->name('save');
        Route::post('update', 'update')->name('update');
    });

// NOTE: Rutas para filtros
Route::controller(FilterController::class)->group(function () {
    Route::get('/filters/date', 'date')->name('obtainDate');
    Route::post('/filters/table','filter')->name('filterDate');
});

// NOTE: Rutas para historial
Route::controller(RecordController::class)->group(function () {
    Route::get('/records/index', 'index')->name('records');
    Route::get('/records/pdf/{id}', 'generatePdf')->name('generatePdf');
});