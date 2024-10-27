<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\User\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::name('api.')->group(function () {
    Route::controller(AuthController::class)->name('auth.')->group(function () {
        Route::post('/register', 'register')->name('register');
        Route::post('/login', 'login')->name('login');
    });

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('logout', [AuthController::class, 'logout'])->name('auth.logout');

        Route::prefix('user')->middleware('roles:user,admin')->name('user.')->group(function () {
            Route::get('/', fn(Request $request) => $request->user())->name('get');
            Route::prefix('posts')->name('posts.')->group(function () {
                Route::get('/index', [PostController::class, 'index'])->name('index');
                Route::post('store', [PostController::class, 'store'])->name('store');
                Route::middleware('owner:post')->group(function () {
                    Route::get('{post}/show', [PostController::class, 'show'])->name('show');
                    Route::put('{post}/update', [PostController::class, 'update'])->name('update');
                    Route::delete('{post}/delete', [PostController::class, 'delete'])->name('delete');
                });
                Route::delete('{post}/destroy', [PostController::class, 'destroy'])->name('destroy')
                    ->withTrashed()
                    ->middleware('roles:admin');
            });
        });
    });
});
