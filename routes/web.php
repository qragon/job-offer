<?php

use App\Http\Controllers\BasketController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'home'])
    ->name('home');

Route::get('/basket', [BasketController::class, 'basket'])
    ->name('basket');

Route::post('/basket/add/{id}', [BasketController::class, 'xhrAddToBasket'])
    ->where('id', '[0-9]+')
    ->name('basket.add');

Route::post('/basket/delete/{id}', [BasketController::class, 'xhrDeleteFromBasket'])
    ->where('id', '[0-9]+')
    ->name('basket.delete');

Route::post('/basket/count/{id}/{action}', [BasketController::class, 'xhrActionCount'])
    ->where('id', '[0-9]+')
    ->where('action', 'plus|minus')
    ->name('basket.count');
