<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Http\Controllers\AccessTokenController;
use Laravel\Passport\Http\Controllers\AuthorizedAccessTokenController;
use Laravel\Passport\Http\Controllers\ClientController;
use Laravel\Passport\Http\Controllers\PersonalAccessTokenController;
use Laravel\Passport\Http\Controllers\ScopeController;
use Laravel\Passport\Http\Controllers\TransientTokenController;


Route::post('auth/login', [AuthController::class, 'login'])->name('auth.login');

// Переопределение роутов паспорта
Route::post('/passport/token', [AccessTokenController::class, 'issueToken'])->name('token');

Route::middleware('auth:api')->group(function () {
    Route::group(['prefix' => '/passport'], function () {
        Route::post('/token/refresh', [TransientTokenController::class, 'refresh'])->name('token.refresh');
        Route::get('/scopes', [ScopeController::class, 'all'])->name('scopes.index');

        Route::group(['prefix' => '/tokens', 'as' => 'tokens.'], function () {
            Route::get('/', [AuthorizedAccessTokenController::class, 'forUser'])->name('index');
            Route::delete('/{token_id}', [AuthorizedAccessTokenController::class, 'destroy'])->name('destroy');
        });

        Route::group(['prefix' => '/clients', 'as' => 'clients.'], function () {
            Route::get('/', [ClientController::class, 'forUser'])->name('index');
            Route::post('/', [ClientController::class, 'store'])->name('store');
            Route::put('/{client_id}', [ClientController::class, 'update'])->name('update');
            Route::delete('/{client_id}', [ClientController::class, 'destroy'])->name('destroy');
        });

        Route::group(['prefix' => '/personal-access-token', 'as' => 'personal.tokens.'], function () {
            Route::get('/', [PersonalAccessTokenController::class, 'forUser'])->name('index');
            Route::post('/', [PersonalAccessTokenController::class, 'store'])->name('store');
            Route::put('/{token_id}', [PersonalAccessTokenController::class, 'destroy'])->name('destroy');
        });
    });

    Route::group(['prefix' => '/auth', 'as' => 'auth.'], function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/me', [AuthController::class, 'me'])->name('me');
    });
});
