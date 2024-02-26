<?php

use App\Http\Controllers\MyClientController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/my-clients', [MyClientController::class, 'show']);
Route::post('/my-clients/create', [MyClientController::class, 'store'])->name('store');
Route::post('/my-clients/update', [MyClientController::class, 'update'])->name('update');
Route::post('/my-clients/delete', [MyClientController::class, 'delete'])->name('delete');
