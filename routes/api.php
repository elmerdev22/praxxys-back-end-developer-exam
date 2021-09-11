<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Admin\{ProductsController};

// Products
Route::group(['prefix' => 'products'], function (){

    Route::get('/', [ProductsController::class, 'index']);
    Route::delete('/delete/{id}', [ProductsController::class, 'delete']);
    Route::post('/add', [ProductsController::class, 'add']);
    Route::get('/edit/{id}', [ProductsController::class, 'edit']);
    Route::post('/update/{id}', [ProductsController::class, 'update']);
    
});

