<?php

use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

Route::get('/', [BookController::class , 'home'])->name('home');

//book crud
Route::get('/index', [BookController::class , 'index'])->name('books.index');
Route::get('/create', [BookController::class , 'create'])->name('books.create');
Route::get('/show{book}', [BookController::class , 'show'])->name('books.show');
Route::get('/{id}/read' , [BookController::class , 'read'])->name('books.read');


