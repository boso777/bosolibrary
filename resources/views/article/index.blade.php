<x-layout>
    <div class="max-w-6xl mx-auto px-4 py-10">

        {{-- Header pagina --}}
        <div class="mb-8 text-center">
            <h1 class="text-2xl font-bold text-white">All books</h1>
            <p class="text-sm text-gray-500 mt-1">{{ $books->total() }} books in the library</p>
        </div>

        {{-- Grid --}}
        @if($books->isEmpty())
            <div class="text-center py-20 text-gray-400 text-sm">
                No books yet. <a href="{{ route('books.create') }}" class="text-indigo-600 hover:underline">Add the first one.</a>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @foreach ($books as $book)
                    <x-article.card :book="$book" />
                @endforeach
            </div>

            {{-- Paginazione --}}
            @if($books->hasPages())
                <div class="mt-10">
                    {{ $books->links() }}
                </div>
            @endif
        @endif

    </div>
</x-layout>