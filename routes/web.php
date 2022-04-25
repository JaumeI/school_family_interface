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
    Route::get('/upload_images', \App\Http\Controllers\DashboardController::class)->name('upload_images');
    Route::get('/see_images', \App\Http\Controllers\DashboardController::class)->name('see_images');
    Route::get('/start_thread', \App\Http\Controllers\DashboardController::class)->name('start_thread');
    Route::get('/messages', \App\Http\Controllers\DashboardController::class)->name('messages');

    // TODO: Resta de rutes que estan protegides per autenticació

});

require __DIR__.'/auth.php';
