<?php

use App\Http\Controllers\UserPrizeController;
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

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard',
        [UserPrizeController::class, 'index']
    )->name('dashboard');

    Route::get('/get-prize',
        [UserPrizeController::class, 'store']
    )->name('get-prize');

    Route::get('/delete-prize/{userPrize}',
        [UserPrizeController::class, 'destroy']
    )->name('delete-prize');

    Route::get('/deliver-prize/{userPrize}',
        [UserPrizeController::class, 'deliver']
    )->name('deliver-prize');

    Route::get('/convert-prize/{userPrize}',
        [UserPrizeController::class, 'convert']
    )->name('convert-prize');
});

require __DIR__.'/auth.php';
