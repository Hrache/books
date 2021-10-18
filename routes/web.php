<?php

use Illuminate\Support\Facades\Route;

use App\Http\Livewire\Welcome;
use App\Http\Livewire\Books;
use App\Http\Livewire\EditBook;

/**
 |--------------------------------------------------------------------------
 | Web Routes
 |--------------------------------------------------------------------------
 |
 | Here is where you can register web routes for your application. These
 | routes are loaded by the RouteServiceProvider within a group which
 | contains the "web" middleware group. Now create something great!
 |
 */

Route::get('/', Welcome::class)->name('home');

Route::middleware(['auth:sanctum', 'verified'])->name('dashboard.')->group(function()
{
    # Dashboard
    Route::get('/dashboard', function()
    {
        return view('dashboard');
    })->name('home');

    # Books
    Route::get('/books', Books::class)->name('books');
    Route::post('/books/store', [Books::class, 'store'])->name('books.store');
    Route::get('/books/edit/{id}', EditBook::class)->name('books.edit');
    Route::patch('/books/update', [EditBook::class, 'update'])->name('books.update');
    Route::delete('/books/delete-author', [EditBook::class, 'deleteAuthor'])->name('books.delete-author');
    Route::delete('/books/delete', [EditBook::class, 'delete'])->name('books.delete');
});
