<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     // return view('welcome');           
//     // Route::get('/', [AdminController::class, 'index']);
// });
Route::get('/adminLogin', [AdminController::class, 'index'])->name('adminLogin');
Route::post('/login', [AdminController::class, 'postLogin'])->name('adminLoginPost');
Route::post('logout', [AdminController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'user-access:admin'])->group(function () {

    Route::get('blog', [BlogController::class, 'blog'])->name('adminblog');
    Route::get('addblog', [BlogController::class, 'addblog'])->name('blogs.create');
    Route::post('storeblog', [BlogController::class, 'store'])->name('blogs.store');
    Route::get('admincomments/{id}', [CommentController::class, 'adcomments'])->name('admin.comments');
});

Route::middleware(['auth', 'user-access:user'])->group(function () {
    Route::get('dashboard', [BlogController::class, 'dashboard'])->name('user.dashboard');
    Route::get('usercomments/{id}', [CommentController::class, 'comments'])->name('user.comments');
    Route::post('storecomments', [CommentController::class, 'store'])->name('comments.store');
    Route::post('replystorecomments', [CommentController::class, 'replystore'])->name('comments.replystore');
});
