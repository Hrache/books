<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Author;

class Welcome extends Component
{
    public function render()
    {
        $Authors = Author::with('books')->paginate(10);

        return view('livewire.welcome',
        [
            'Authors' => $Authors
        ])
        ->extends('layouts.guest', ['PageTitle' => "Public page"])
        ->section('body');
    }
}

?>
