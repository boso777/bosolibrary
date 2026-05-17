<div class="flex flex-col c-bg-dark border border-gray-800 rounded-2xl shadow-sm overflow-hidden w-full transition-all duration-300 hover:border-red-600/30">

    {{-- Immagine: altezza fissa, ritagliata --}}
    <a href="{{ route('books.show', $book) }}" class="block h-48 overflow-hidden flex-shrink-0 relative">
        <img
            class="w-full h-full object-cover transition-transform duration-500 hover:scale-105"
            src="{{ Storage::url($book->cover_image) }}"
            alt="{{ $book->title }}"
        />
        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-40"></div>
    </a>

    {{-- Contenuto --}}
    <div class="flex flex-col flex-1 p-4 gap-3">

        {{-- Categorie --}}
        @if($book->categories->isNotEmpty())
            <div class="flex flex-wrap gap-1">
                @foreach ($book->categories as $category)
                    <span class="inline-flex items-center bg-red-600/10 border border-red-600/20 text-red-500 text-[10px] font-semibold px-2 py-0.5 rounded-full uppercase tracking-wider">
                        {{ $category->name }}
                    </span>
                @endforeach
            </div>
        @endif

        {{-- Titolo --}}
        <h5 class="text-base font-semibold c-text-secondary line-clamp-2 leading-snug font-secondary">
            {{ $book->title }}
        </h5>

        {{-- Spacer --}}
        <div class="flex-1"></div>

        {{-- CTA --}}
        <a href="{{ route('books.show', $book) }}"
           class="inline-flex items-center justify-center gap-1.5 c-bg-primary c-text-secondary text-sm font-semibold px-4 py-2 rounded-full hover:opacity-90 transition-all duration-200 shadow-sm">
            Read More
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                <path d="M19 12H5m14 0-4 4m4-4-4-4"/>
            </svg>
        </a>
    </div>
</div>