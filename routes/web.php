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
Route::redirect('/', '/login');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', \App\Http\Controllers\Messages\MessageIndexController::class)->name('messages');

    //Messages
    Route::get('/message', \App\Http\Controllers\Messages\MessageIndexController::class)->name('messages');
    Route::get('/message/create', \App\Http\Controllers\Messages\MessageCreateController::class)->name('messages.create');
    Route::post('/message', \App\Http\Controllers\Messages\MessageStoreController::class)->name('messages.store');
    Route::get('/message/{id}/edit', \App\Http\Controllers\Messages\MessageEditController::class)->name('messages.edit');
    Route::put('/message/{id}', \App\Http\Controllers\Messages\MessageUpdateController::class)->name('messages.update');
    Route::delete('/message/{id}', \App\Http\Controllers\Messages\MessageDestroyController::class)->name('messages.destroy');

    //Images
    Route::get('/image', \App\Http\Controllers\Images\ImageIndexController::class)->name('images');
    Route::get('/image/create', \App\Http\Controllers\Images\ImageCreateController::class)->name('images.create');
    Route::post('/image', \App\Http\Controllers\Images\ImageStoreController::class)->name('images.store');
    Route::get('/image/{id}/edit', \App\Http\Controllers\Images\ImageEditController::class)->name('images.edit');
    Route::put('/image/{id}', \App\Http\Controllers\Images\ImageUpdateController::class)->name('images.update');
    Route::delete('/image/{id}', \App\Http\Controllers\Images\ImageDestroyController::class)->name('images.destroy');

    //Users
    Route::get('/users', \App\Http\Controllers\Users\UserIndexController::class)->name('users');
    Route::get('/users/create', \App\Http\Controllers\Users\UserCreateController::class)->name('users.create');
    Route::post('/users', \App\Http\Controllers\Users\UserStoreController::class)->name('users.store');
    Route::get('/users/{id}/edit', \App\Http\Controllers\Users\UserEditController::class)->name('users.edit');
    Route::put('/users/{id}', \App\Http\Controllers\Users\UserUpdateController::class)->name('users.update');
    Route::delete('/users/{id}', \App\Http\Controllers\Users\UserDestroyController::class)->name('users.destroy');

    //Groups
    Route::get('/groups', \App\Http\Controllers\Groups\GroupIndexController::class)->name('groups');
    Route::get('/groups/create', \App\Http\Controllers\Groups\GroupCreateController::class)->name('groups.create');
    Route::post('/groups', \App\Http\Controllers\Groups\GroupStoreController::class)->name('groups.store');
    Route::get('/groups/{id}/edit', \App\Http\Controllers\Groups\GroupEditController::class)->name('groups.edit');
    Route::put('/groups/{id}', \App\Http\Controllers\Groups\GroupUpdateController::class)->name('groups.update');
    Route::delete('/groups/{id}', \App\Http\Controllers\Groups\GroupDestroyController::class)->name('groups.destroy');

    //Students
    Route::get('/students', \App\Http\Controllers\Students\StudentIndexController::class)->name('students');
    Route::get('/students/create', \App\Http\Controllers\Students\StudentCreateController::class)->name('students.create');
    Route::post('/students', \App\Http\Controllers\Students\StudentStoreController::class)->name('students.store');
    Route::get('/students/{id}/edit', \App\Http\Controllers\Students\StudentEditController::class)->name('students.edit');
    Route::put('/students/{id}', \App\Http\Controllers\Students\StudentUpdateController::class)->name('students.update');
    Route::delete('/students/{id}', \App\Http\Controllers\Students\StudentDestroyController::class)->name('students.destroy');

    //Tags
    Route::get('/tags', \App\Http\Controllers\Tags\TagIndexController::class)->name('tags');
    Route::get('/tags/create', \App\Http\Controllers\Tags\TagCreateController::class)->name('tags.create');
    Route::post('/tags', \App\Http\Controllers\Tags\TagStoreController::class)->name('tags.store');
    Route::get('/tags/{id}/edit', \App\Http\Controllers\Tags\TagEditController::class)->name('tags.edit');
    Route::put('/tags/{id}', \App\Http\Controllers\Tags\TagUpdateController::class)->name('tags.update');
    Route::delete('/tags/{id}', \App\Http\Controllers\Tags\TagDestroyController::class)->name('tags.destroy');

});

require __DIR__.'/auth.php';
