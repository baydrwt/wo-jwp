<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;

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

Route::get('/', [HomeController::class, 'index']);
Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::middleware(['admin'])->group(function () {
    Route::resource('/dashboard/katalogs', KatalogController::class)->except(['show', 'edit', 'update']);
    Route::get('/dashboard/katalogs/{katalogs:id}/edit', [KatalogController::class, 'edit']);
    Route::put('/dashboard/katalogs/{katalogs:id}', [KatalogController::class, 'update']);

    Route::resource('/dashboard/orders', OrderController::class)->except(['show', 'edit', 'update']);
    Route::put('/dashboard/orders/{order:id}', [OrderController::class, 'updateStatus'])->name('approve.by.admin');
    Route::delete('/dashboard//orders/{order:id}', [OrderController::class, 'destroy'])->name('destroy');
});