<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Log;

use App\Models\Book;
use App\Models\Author;
use App\Models\BookAuthor;

class Books extends Component
{
    public function render()
    {
        return view('books',
        [
            'Authors' => Author::with('books')->orderBy('id', 'DESC')->paginate(10, ['*'], 'authors'),
            'AllAuthors' => Author::with('books')->get(),
            'Books' => Book::with('authors')->orderBy('id', 'DESC')->paginate(10, ['*'], 'books')
        ])->layout('layouts.app');
    }

    public function store()
    {
        $valid = validator()->make(request()->post(),
        [
            'title' => 'required|string|max:191',
            'release_date' => 'required|numeric|max:3000',
            'author' => 'required|numeric|exists:authors,id'
        ]);

        if (!empty($valid->errors()->getMessages()))
        {
            session()->flash('message', $valid->errors()->getMessages());
            return back();
        }

        $Book = new Book();
        $Book->fill(
        [
            "title" => request()->post('title'),
            "released_at" => request()->post('release_date')
        ])->saveOrFail();

        $BAPivot = new BookAuthor();
        $BAPivot->fill(
        [
            'books_id' => intval($Book->id),
            'authors_id' => intval(request()->post('author'))
        ])->saveOrFail();

        session()->flash('message', 'New book have been added successfully!');

        return redirect()->route('dashboard.books');
    }
}