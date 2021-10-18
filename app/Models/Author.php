<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Book;
use App\Models\BookAuthor;

class Author extends Model
{
    use HasFactory;

    protected $table = "authors";

    public function books()
    {
        return $this->belongsToMany(Book::class, BookAuthor::class, 'authors_id', 'books_id');
    }
}
