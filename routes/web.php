<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Gate as FacadesGate;
use Illuminate\Support\Facades\Route;

// User related routes
Route::get('/', [UserController::class, 'showCorrectHomepage'])->name('login');

Route::post('/register', [UserController::class, 'register'])->middleware('guest');

Route::post('login', [UserController::class, 'login'])->middleware('guest');

Route::post('logout', [UserController::class, 'logout'])->middleware('mustBeLoggedIn');

// Blog post related routes
Route::get('/create-post', [PostController::class, 'showCreateForm'])->middleware('mustBeLoggedIn');

Route::post('/create-post', [PostController::class, 'storeNewPost'])->middleware('mustBeLoggedIn');

Route::get('/post/{post}', [PostController::class, 'viewSinglePost']);

Route::delete('/post/{post}', [PostController::class, 'delete'])->middleware('can:delete,post');

Route::get('/post/{post}/edit', [PostController::class, 'showEditForm'])->middleware('can:update,post');

Route::put('/post/{post}', [PostController::class, 'actuallyUpdate'])->middleware('can:update,post');

// Profile related routes
Route::get('/profile/{user:username}', [UserController::class, 'profile']);



Route::get('/admin-only', function () {
    // if (FacadesGate::allows('visitAdminPages')) {
    //     return 'Only admin can see this page';
    // }

    // return 'You cannot view this page';

    return 'Only admin can see this page';
})->middleware('can:visitAdminPages');
