<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Books') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="mx-auto sm:px-6 lg:px-8 p-2">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg grid sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-3">

            {{-- Add new book --}}
            <section class="p-4 sm:border-0 md:border-l lg:border-">
                <h2 class="text-gray-700 mb-2 text-2xl font-bold px-2">{{ __('Add new book') }}</h2>
                <form method="post" action="{{ route('dashboard.books.store') }}" class="grid sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-1">
                    @csrf
                    <div class="p-2">
                        <label for="BookTitle">{{ __('Title') }}</label><br />
                        <input type="text" name="title" value="" class="w-full" id="BookTitle" required />
                    </div>

                    <div class="p-2">
                        <label for="BookAuthor">{{ __('Author') }}</label><br />
                        <select class="w-full" name="author" id="BookAuthor" required>
                            @foreach($AllAuthors as $AuthorKey => $Author)
                            <option value="{{ $Author->id }}">{{ $Author->full_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="p-2">
                        <label for="BookReleaseDate">{{ __('Release date') }}</label><br />
                        <input type="number" class="w-full" value="2020" name="release_date" min="1" max="3000" id="BookReleaseDate" required />
                    </div>

                    <footer class="p-2">
                        <input type="submit" value="Create" class="p-2 px-4 bg-red-600 text-white cursor-pointer" />
                    </footer>
                </form>
            </section>

            {{-- List of books --}}
            <section class="p-4">
                <h2 class="text-gray-700 mb-2 text-2xl font-bold px-2">{{ __('Books') }}</h2>

                <p class="p-2">
                    {{-- Pagination --}}
                    <header class="p-2">
                        {{ $Books->links() }}
                    </header>

                    @foreach($Books as $Bookey => $Book)
                    <article class="p-2">
                        <h3 class="text-xl font-bold text-blue-900">
                            <a href="{{ route('dashboard.books.edit', ['id' => $Book->id]) }}">{{ $Book->title }}</a>
                        </h3>

                        @foreach($Book->authors as $AuthorKey => $Author)
                        <div class="text-sm">{{ $Author->full_name }}</div>
                        @endforeach
                    </article>
                    @endforeach
                </p>
            </section>

            {{-- List of authors --}}
            <section class="p-4">
                <h2 class="text-gray-700 mb-2 text-2xl font-bold px-2">{{ __('Authors') }}</h2>

                <div class="p-2">
                    {{-- Pagination --}}
                    <header class="p-2">
                        {{ $Authors->links() }}
                    </header>

                    @foreach($Authors as $AuthorKey => $Author)
                    <article class="p-2">
                        <h3 class="text-xl font-bold text-blue-900">{{ $Author->full_name }}</h3>
                        <div><i>has {{ $Author->books->count() }} book{{ ($Author->books->count() > 1)? 's': '' }}</i></div>
                    </article>
                    @endforeach
                </div>
            </section>
        </div>
    </div>
</div>
