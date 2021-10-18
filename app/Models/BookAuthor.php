<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookAuthor extends Model
{
    use HasFactory;

    protected $fillable = ['books_id', 'authors_id'];

    protected $table = "books_authors";
}