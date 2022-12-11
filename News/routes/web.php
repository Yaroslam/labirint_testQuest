<?php

use Illuminate\Support\Facades\Route;

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


Route::post("/create", [\App\Http\Controllers\NewsController::class, "createNews"]);
Route::get("/delete", [\App\Http\Controllers\NewsController::class, "deleteNews"]);
Route::get("/news", [\App\Http\Controllers\NewsController::class, "getNews"]);
