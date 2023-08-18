<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;
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

Route::get('/', function () {
    return view('welcome');
})->middleware(['password.confirm']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard')->middleware('verified');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//middleware(['auth'])...loginしていたらそれ以降のルーティングにアクセスできる。
//prefix('book')...localhost/bookとurlを叩いた時のルーティングをgroupでまとめる
//localhost/book/のときBookController(app/Http/Controller/)のindexメソッドを呼び出す
Route::middleware(['auth'])->prefix('book')->group(function () {
    Route::get('/', [BookController::class, 'index'])->name('book');
    Route::get('/detail/{id}', [BookController::class, 'detail'])->name('book.detail');
});

require __DIR__ . '/auth.php';
