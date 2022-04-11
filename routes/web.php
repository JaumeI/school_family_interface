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

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::redirect('/', '/login');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', \App\Http\Controllers\DashboardController::class)->name('dashboard');
    Route::get('/users', \App\Http\Controllers\DashboardController::class)->name('users');
    Route::get('/students', \App\Http\Controllers\DashboardController::class)->name('students');
    Route::get('/groups', \App\Http\Controllers\DashboardController::class)->name('groups');

    // TODO: Resta de rutes que estan protegides per autenticació

});

require __DIR__.'/auth.php';
