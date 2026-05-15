<div class="flex flex-col bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden w-full">

    {{-- Immagine: altezza fissa, ritagliata --}}
    <a href="{{ route('books.show', $book) }}" class="block h-48 overflow-hidden flex-shrink-0">
        <img
            class="w-full h-full object-cover transition-transform duration-300 hover:scale-105"
            src="{{ Storage::url($book->cover_image) }}"
            alt="{{ $book->title }}"
        />
    </a>

    {{-- Contenuto --}}
    <div class="flex flex-col flex-1 p-4 gap-3">

        {{-- Categorie --}}
        @if($book->categories->isNotEmpty())
            <div class="flex flex-wrap gap-1">
                @foreach ($book->categories as $category)
                    <span class="inline-flex items-center bg-indigo-50 border border-indigo-100 text-indigo-700 text-xs font-medium px-2 py-0.5 rounded-full">
                        {{ $category->name }}
                    </span>
                @endforeach
            </div>
        @endif

        {{-- Titolo --}}
        <h5 class="text-base font-semibold text-gray-900 line-clamp-2 leading-snug">
            {{ $book->title }}
        </h5>

        {{-- Spacer --}}
        <div class="flex-1"></div>

        {{-- CTA --}}
        <a href="{{ route('books.show', $book) }}"
           class="inline-flex items-center justify-center gap-1.5 bg-gray-600 text-white text-sm font-medium px-4 py-2 rounded-full hover:bg-lime-400 hover:text-black   transition-colors duration-200">
            See more
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                <path d="M19 12H5m14 0-4 4m4-4-4-4"/>
            </svg>
        </a>
    </div>
</div>