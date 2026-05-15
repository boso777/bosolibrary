<x-layout>
    <div class="flex align-middle justify-evenly">
        @foreach ($books as $book)
            <div class="mt-8">
                <x-article.card :book="$book"></x-article.card>
            </div>
        @endforeach
    </div>
</x-layout>
