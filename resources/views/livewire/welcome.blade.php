@section('body')
<div class="relative flex items-top min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
    @if (Route::has('login'))
    <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
    @auth
        <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
    @else
        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

        @if (Route::has('register'))
        <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
        @endif
    @endauth
    </div>
    @endif

    <div class="w-full sm:px-6 lg:px-8">
    @empty ($Authors)
        <section class="text-2xl text-center">
            There were no books in the database
        </section>
    @else
        @include('partials.authors-books', ['Authors' => $Authors])
    @endif
    </div>
</div>
@endsection

@section('headstyle')
<style>
.max-h-0 {
    max-height: 0;
}
</style>
@endsection