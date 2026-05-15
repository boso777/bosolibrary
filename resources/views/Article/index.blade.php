<x-layout>
    @foreach ($books as $book)
        <x-article.card :book="$book"></x-article.card>
    @endforeach
</x-layout>