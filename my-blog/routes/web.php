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

Route::get('/', function () {
    return view('welcome');
});
use App\Http\Controllers\BlogPostController ;

Route::get('blog', [BlogPostController::class, 'index'])->name('blog.index');
Route::get('blog/{blogPost}', [BlogPostController::class, 'show'])->name('blog.show');
Route::get('blog-create', [BlogPostController::class, 'create'])->name('blog.create');
Route::post('blog-create', [BlogPostController::class, 'store'])->name('blog.store');
Route::get('blog-edit/{blogPost}', [BlogPostController::class, 'edit'])->name('blog.edit');
Route::put('blog-edit/{blogPost}', [BlogPostController::class, 'update']);
Route::delete('blog-edit/{blogPost}', [BlogPostController::class, 'destroy']);

//test eloquent
Route::get('query', [BlogPostController::class, 'query']);
Route::get('page', [BlogPostController::class, 'page']);

use App\Http\Controllers\CustomAuthController;

Route::get('registration', [CustomAuthController::class, 'create'])->name('user.create');
Route::post('registration', [CustomAuthController::class, 'store'])->name('user.store');
Route::get('login', [CustomAuthController::class, 'index'])->name('user.index');