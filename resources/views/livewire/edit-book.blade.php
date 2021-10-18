<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        <i class="font-bold">{{ $Book->title }}</i> <span class="text-sm">({{ __('Edit') }})</span>
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 p-2">

        <form action="{{ route('dashboard.books.delete') }}" class="p-4 bg-white overflow-hidden shadow-xl sm:rounded-lg mb-2" method="post">
            @csrf
            @method('delete')
            <input type="hidden" name="book_id" value="{{ $this->book_id }}" />
            <input type="submit" value="Delete the book" class="p-2 border border-red-400 rounded bg-white hover:text-gray-100 hover:bg-red-500 cursor-pointer" />
        </form>

        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg grid sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-4 xl:grid-cols-4">

            {{-- Book authors form --}}
            <div class="p-4" id="AuthorsList">
                <h2 class="text-2xl font-bold p-2">Author/s</h2>

                @foreach($Book->authors as $AuthorKey => $Author)
                <article class="p-2">
                    <form action="{{ route('dashboard.books.delete-author') }}" method="post">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="ids" value="{{ json_encode(['authors_id' => $Author->id, 'books_id' => $Book->id]) }}" />
                        <input type="submit" value="Delete" class="p-2 cursor-pointer text-sm bg-red-600 text-white float-right" />
                    </form>

                    <h3 class="text-xl font-bold text-blue-900">{{ $Author->full_name }}</h3>
                    <div><i>has {{ $Author->books->count() }} book{{ ($Author->books->count() > 1)? 's': '' }}</i></div>
                </article>
                @endforeach
            </div>

            {{-- Book update form --}}
            <form id="UpdateForm" method="post" action="{{ route('dashboard.books.update') }}" class="p-4  lg:col-span-2 xl:col-span-3">
                @csrf
                @method('patch')
                <div class="p-2">

                    {{-- new or old title of the book --}}
                    <label for="BookTitle">{{ __('Title') }}</label><br />
                    <input type="text" name="title" value="{{ $Book->title }}" class="w-full mb-2" id="BookTitle" />

                    {{-- new author --}}
                    <label for="BookAuthor">{{ __('Author') }}</label><br />
                    <select class="w-full mb-2" name="author" id="BookAuthor">
                        <option value=""></option>
                        @foreach($Authors as $AuthorKey => $Author)
                        <option value="{{ $Author->id }}">{{ $Author->full_name }}</option>
                        @endforeach
                    </select>

                    {{-- new release date --}}
                    <label for="BookReleaseDate">{{ __('Released at') }}</label><br />
                    <input type="number" value="{{ $Book->released_at }}" name="release_date" id="BookReleaseDate" class="w-full" min="1" max="3000" />
                </div>

                {{-- book id --}}
                <input type="hidden" value="{{ $Book->id }}" name="book_id" id="BookId" />

                <div class="p-2">
                    <input type="submit" value="Update" class="p-2 px-4 bg-red-600 text-white" />
                </div>
            </form>
        </div>
    </div>
</div>

<script>
(function()
{
    let Authors = document.querySelectorAll( '#AuthorsList > article');

    // let UpdateForm = document.querySelector( '#UpdateForm');
    // UpdateForm.onsubmit = function( event )
    // {
    //     event.preventDefault();
    //     console.log( event.target );
    // };

    for ( let i in Authors )
    {
        Authors[ i ].onclick = function( event )
        {
            if ( Authors.length <= 1 )
            {
                alert( "The book should have at least one author!");

                return false;
            }
        };
    }
})()
</script>