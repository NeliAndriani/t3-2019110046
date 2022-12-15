<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\AuthorBookController;

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

Route::resource('books', BookController::class);

Route::get('/books', [BookController::class,'index'])->name('books.index');
Route::get('/books/create', [BookController::class,'create'])->name('books.create');
Route::post('/books', [BookController::class,'store'])->name('books.store');
Route::get('/books/{book}', [BookController::class,'show'])->name('books.show');
Route::get('/books/{book}/edit', [BookController::class,'edit'])->name('books.edit');
Route::patch('/books/{book}', [BookController::class,'update'])->name('books.update');
Route::delete('/books/{book}', [BookController::class,'destroy'])->name('books.destroy');


Route::resource('authors', AuthorController::class);

Route::get('/authors', [AuthorController::class,'index'])->name('authors.index');
Route::get('/authors/create', [AuthorController::class,'create'])->name('authors.create');
Route::post('/authors', [AuthorController::class,'store'])->name('authors.store');
Route::get('/authors/{author}', [AuthorController::class,'show'])->name('authors.show');
Route::get('/authors/{author}/edit', [AuthorController::class,'edit'])->name('authors.edit');
Route::patch('/authors/{author}', [AuthorController::class,'update'])->name('authors.update');
Route::delete('/authors/{author}', [AuthorController::class,'destroy'])->name('authors.destroy');


Route::prefix('/relations')->group(function () {
    Route::get('/find', [AuthorController::class, 'find']);
    Route::get('/all-join', [AuthorController::class, 'allJoin']);
    Route::get('/with-count', [AuthorController::class, 'withCount']);
   });
