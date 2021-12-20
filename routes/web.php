<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LangController;

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

Route::resource('/posts', PostController::class);

/*Route::get('/', function () {
    return view('about');
});*/

Route::get('/', [PostController::class, 'index']);

Route::get('/about', function() {
    return view('about');
});

Route::get('/hh', [LangController::class, 'hh']);

