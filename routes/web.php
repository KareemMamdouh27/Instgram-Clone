<?php

use App\Http\Controllers\followsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ProfileController;
use App\Mail\NewUserWelcomeMail;

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

Route::get('/email', function() {
    return new NewUserWelcomeMail();
});

Auth::routes();

Route::put('/p/{post}',[PostsController::class, 'update'])->name('post.update');
Route::post('/follow/{user}', [followsController::class, 'store']);
Route::get('/', [PostsController::class, 'index'])->name('HOME');
Route::get('/p/create', [PostsController::class, 'create']);
Route::get('/p/{post}', [PostsController::class, 'show'])->name('post.show');
Route::post('/p',[PostsController::class, 'store']);
Route::get('/profile/{user}/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::get('/profile/{user}', [ProfileController::class, 'index'])->name('profile.show');
Route::patch('/profile/{user}', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/p/{post}', [PostsController::class, 'destroy'])->name('post.delete');
Route::get('/p/{post}/edit', [PostsController::class, 'edit'])->name('posts.edit');

