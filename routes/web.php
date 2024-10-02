<?php

use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\ProductController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::group(['middleware' => 'auth'], function(){
    Route::get('/products',         [ProductController::class, 'index'])->name('dashboard');
    Route::post('/products/export', [ProductController::class, 'export']);
    Route::get('/products/exports', [ProductController::class, 'show']);
    
    Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function(){
        Route::get('/products',                [AdminProductController::class, 'index'])->name('admin');
        Route::post('/products',               [AdminProductController::class, 'store']);
        Route::get('/products/create',         [AdminProductController::class, 'create']);
        Route::get('/products/{product}/edit', [AdminProductController::class, 'edit']);
        Route::put('/products/{product}',      [AdminProductController::class, 'update']);
    });    
});

require __DIR__.'/auth.php';
