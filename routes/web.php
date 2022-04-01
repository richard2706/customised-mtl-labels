<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/settings', [UserController::class, 'edit'])
    ->middleware(['auth'])->name('user.settings');

Route::post('/settings/update/{user}', [UserController::class, 'update'])
    ->middleware(['auth'])->name('user.update');

Route::get('/scan', [ProductController::class, 'scan'])
    ->name('product.scan');

Route::post('/scan', [ProductController::class, 'findProduct'])
    ->name('product.find');

Route::get('/product/{barcode}', [ProductController::class, 'label'])
    ->name('product.show');

require __DIR__.'/auth.php';
