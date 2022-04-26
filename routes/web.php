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
    //Route::get('/users', \App\Http\Controllers\DashboardController::class)->name('users');
    //Users
    Route::get('/users', \App\Http\Controllers\Users\UserIndexController::class)->name('users');
    Route::get('/users/create', \App\Http\Controllers\Users\UserCreateController::class)->name('users.create');
    Route::post('/users', \App\Http\Controllers\Users\UserStoreController::class)->name('users.store');
    Route::get('/users/{id}/edit', \App\Http\Controllers\Users\UserEditController::class)->name('users.edit');
    Route::put('/users/{id}', \App\Http\Controllers\Users\UserUpdateController::class)->name('users.update');
    Route::delete('/users/{id}', \App\Http\Controllers\Users\UserDestroyController::class)->name('users.destroy');


    Route::get('/students', \App\Http\Controllers\DashboardController::class)->name('students');
    Route::get('/groups', \App\Http\Controllers\DashboardController::class)->name('groups');
    Route::get('/upload_images', \App\Http\Controllers\DashboardController::class)->name('upload_images');
    Route::get('/see_images', \App\Http\Controllers\DashboardController::class)->name('see_images');
    Route::get('/start_thread', \App\Http\Controllers\DashboardController::class)->name('start_thread');
    Route::get('/messages', \App\Http\Controllers\DashboardController::class)->name('messages');

    // TODO: Resta de rutes que estan protegides per autenticació

});

require __DIR__.'/auth.php';
