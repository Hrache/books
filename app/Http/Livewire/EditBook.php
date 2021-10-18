<?php

namespace App\Http\Livewire;

use Illuminate\Support\Str;
use Livewire\Component;
use App\Models\Book;
use App\Models\Author;
use App\Models\BookAuthor;

class EditBook extends Component
{
    protected $book_id;

    public function render()
    {
        return view('livewire.edit-book',
        [
            'Book' => Book::with('authors')->whereId(intval($this->book_id))->first(),
            'Authors' => Author::all()
        ])->layout('layouts.app');
    }

    public function mount($id)
    {
        $this->book_id = $id;
    }

    public function update()
    {
        $valid = validator()->make(request()->post(),
        [
            'title' => 'required|string|max:191',
            'book_id' => 'required|numeric|exists:books,id',
            'release_date' => 'sometimes|numeric|min:1|max:3000',
            'author' => 'nullable|numeric|exists:authors,id'
        ], [
            'title' => 'Not valid title',
            'release_date' => 'Not valid release date',
            'author' => 'Author info you provided isn\'t valid',
            'book_id' => 'Book info you provided isn\'t valid'
        ]);

        if (!empty($valid->errors()->getMessages()))
        {
            session()->flash('message', $valid->errors()->getMessages());
            return back();
        }

        $Book = Book::whereId(request()->post('book_id'));
        $Book->update(
        [
            'title' => request()->post('title'),
            'released_at' => request()->post('release_date')
        ]);

        if (!empty(request()->post('author')))
        {
            $Pivot = BookAuthor::where(
            [
                'books_id' => request()->post('book_id'),
                'authors_id' => request()->post('author')
            ]);

            if ($Pivot->count() <= 0)
            {
                $NewPivot = new BookAuthor();
                $NewPivot->books_id = request()->post('book_id');
                $NewPivot->authors_id = request()->post('author');

                $NewPivot->saveOrFail();
            }
        }

        session()->flash('message', "Changes to the book have been made successfully!");

        return back();
    }

    public function deleteAuthor()
    {
        $valid = request()->validate(
        [
            'ids' => 'required|json'
        ]);

        if (!$valid)
        {
            session()->flash('message', "Validation error: your data doesn't seem to be valid!");

            return back();
        }

        $ids = json_decode(request()->post('ids'));

        if (BookAuthor::where('books_id', intval($ids->books_id))->count() <= 1)
        {
            session()->flash('message', "At least one author should be for the book!");

            return back();
        }

        $ToDelete = BookAuthor::where(
        [
            'books_id' => $ids->books_id,
            'authors_id' => $ids->authors_id
        ])->delete();

        session()->flash('message', "The author has been deleted successfully!");

        return back();
    }

    public function delete()
    {
        Book::whereId(request()->post('book_id'))->delete();

        session()->flash('message', "The book have been deleted from the database!");

        return redirect()->route('dashboard.books');
    }
}