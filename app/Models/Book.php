<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Author;
use App\Models\BookAuthor;

class Book extends Model
{
    use HasFactory;

    protected $table = "books";
    protected $fillable = ['title', 'released_at'];

    public function authors()
    {
        return $this->belongsToMany(Author::class, BookAuthor::class, 'books_id', 'authors_id');
    }
}
