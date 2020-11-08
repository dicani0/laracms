<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    return view('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');;
Route::resource('posts', PostsController::class)->only(['index', 'show']);
Route::get('posts/category/{category}', [PostsController::class, 'indexWithCategory'])->name('postsWithCategory');
Route::get('posts/tag/{tag}', [PostsController::class, 'indexWithTag'])->name('postsWithTag');
Route::middleware(['auth'])->group(function () {
    Route::resource('categories', CategoriesController::class);
    Route::resource('posts', PostsController::class)->except(['index', 'show']);
    Route::resource('tags', TagsController::class);
    Route::resource('users', UsersController::class)->middleware('verifyAdmin');
    Route::get('profile', [UsersController::class, 'edit'])->name('users.edit-profile');
    Route::put('profile/update', [UsersController::class, 'update'])->name('users.update-profile');
    Route::post('users/{user}/giveAdmin', [UsersController::class, 'giveAdmin'])->middleware('verifyAdmin')->name('users.give-admin');
    Route::get('trashed-posts', [PostsController::class, 'trash'])->name('trashed-posts.index');
    Route::put('/restore-post/{post}', [PostsController::class, 'restore'])->name('restore-posts');
});
