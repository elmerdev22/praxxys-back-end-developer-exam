<?php
use App\Http\Controllers\Admin\Auth\{LoginController};
use App\Http\Controllers\Admin\{DashboardController, ProductsController, VideosController};
use App\Http\Controllers\Auth\{LogoutController, LoginRedirectController};

// Admin Login
Route::group(['middleware' => ['guest']], function(){
    Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin'], function () {
        Route::match(['GET', 'POST'], '/login', [LoginController::class, 'login'])->name('login');
    });
});

// Login Redirect
Route::group(['prefix' => 'login-redirect', 'as' => 'login-redirect.', 'namespace' => 'Auth'], function () {
    Route::get('/', [LoginRedirectController::class, 'index'])->name('index');
});

// If Auth
Route::group(['middleware' => ['auth']], function(){
    Route::get('/logout', [LogoutController::class, 'index'])->name('logout');
});

// Admin Group
Route::group(['middleware' => ['auth', 'auth.admin']], function(){
    Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin'], function () {
        
        // Dashboard
        Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.'], function (){

            Route::get('/', [DashboardController::class, 'index'])->name('index');
            
        });

        // Products
        Route::group(['prefix' => 'products', 'as' => 'products.'], function (){

            Route::get('/', [ProductsController::class, 'index'])->name('index');
            Route::get('/create', [ProductsController::class, 'create'])->name('create');
            Route::get('/edit/{id}', [ProductsController::class, 'edit'])->name('edit');
            
        });

        // Videos
        Route::group(['prefix' => 'videos', 'as' => 'videos.'], function (){

            Route::get('/', [VideosController::class, 'index'])->name('index');
            
        });

    });
});

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

