<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LangController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\TickerController;

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

Route::get('/', [TickerController::class, 'index']);

Route::get('/about', function() {
    return view('about');
});

Route::get('/hh', [LangController::class, 'hh']);

Route::get('/currencies', [CurrencyController::class, 'currencies']);

