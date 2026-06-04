<x-layout>
    {{-- Hero Section --}}
    <div class="relative overflow-hidden c-bg-dark py-24 sm:py-32">
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-gradient-to-b from-transparent to-[#050505] opacity-90"></div>
            {{-- Optional: Add a subtle background pattern or image here --}}
        </div>

        <div class="relative z-10 mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl text-center">
                <h1 class="font-secondary text-4xl font-bold tracking-tight c-text-secondary sm:text-6xl">
                    Your Personal <span class="c-text-primary">Digital Library</span>
                </h1>
                <p class="mt-6 text-lg leading-8 text-gray-300 font-primary">
                    Organize, read, and explore your collection of E-books, PDFs, and presentations in one elegant place. 
                    YouLib brings your reading experience to the next level.
                </p>
                <div class="mt-10 flex items-center justify-center gap-x-6">
                    <a href="@auth {{ route('books.index') }} @endauth @guest{{ route('login') }} @endguest" 
                       class="rounded-full c-bg-primary px-6 py-3.5 text-sm font-semibold c-text-secondary shadow-sm hover:opacity-90 transition-all duration-200 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">
                        Explore Collection
                    </a>
                    <a href="@auth {{ route('books.create') }} @endauth @guest{{ route('login') }} @endguest"  class="text-sm font-semibold leading-6 c-text-secondary hover:c-text-primary transition-colors">
                        Add a Book <span aria-hidden="true">→</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Latest Books Section - Restricted to Auth Users --}}
    @auth
    <div class="c-bg-dark py-24 sm:py-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl lg:mx-0">
                <h2 class="font-secondary text-3xl font-bold tracking-tight c-text-secondary sm:text-4xl">Your Recent Books</h2>
                <p class="mt-2 text-lg leading-8 text-gray-400 font-primary">Continue reading where you left off.</p>
            </div>

            @if($latestBooks->isEmpty())
                <div class="mt-16 text-center py-12 border-2 border-dashed border-gray-800 rounded-2xl">
                    <p class="text-gray-500 font-primary">Your library is currently empty.</p>
                    <a href="{{ route('books.create') }}" class="mt-4 inline-block c-text-primary hover:underline font-semibold transition-all">Start by adding your first book</a>
                </div>
            @else
                <div class="mx-auto mt-16 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-12 sm:grid-cols-2 lg:mx-0 lg:max-w-none lg:grid-cols-4">
                    @foreach($latestBooks as $book)
                        <article class="flex flex-col items-start group">
                            <div class="relative w-full overflow-hidden rounded-2xl aspect-[3/4] c-bg-dark border border-gray-800 transition-all duration-300 group-hover:border-red-600/50">
                                <img src="{{ Storage::url($book->cover_image) }}" alt="{{ $book->title }}" class="absolute inset-0 h-full w-full object-cover transition-transform duration-500 group-hover:scale-105">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-60"></div>
                                <div class="absolute bottom-4 left-4 right-4">
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($book->categories->take(2) as $category)
                                            <span class="inline-flex items-center rounded-md bg-red-600/10 px-2 py-1 text-xs font-medium text-red-500 ring-1 ring-inset ring-red-600/20">
                                                {{ $category->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                                <a href="{{ route('books.show', $book) }}" class="absolute inset-0 z-20"></a>
                            </div>
                            <div class="max-w-xl mt-4">
                                <div class="flex items-center gap-x-4 text-xs">
                                    <time datetime="{{ $book->created_at->format('Y-m-d') }}" class="text-gray-500">
                                        {{ $book->created_at->diffForHumans() }}
                                    </time>
                                </div>
                                <div class="group relative">
                                    <h3 class="mt-3 text-lg font-semibold leading-6 c-text-secondary group-hover:c-text-primary transition-colors">
                                        <a href="{{ route('books.show', $book) }}">
                                            <span class="absolute inset-0"></span>
                                            {{ $book->title }}
                                        </a>
                                    </h3>
                                    <p class="mt-2 line-clamp-2 text-sm leading-6 text-gray-400 font-primary">{{ $book->description }}</p>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
    @endauth

    {{-- Features Section --}}
    <div class="relative isolate overflow-hidden bg-white/5 py-24 sm:py-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 sm:gap-y-20 lg:mx-0 lg:max-w-none lg:grid-cols-2 lg:items-center">
                <div class="lg:pr-8 lg:pt-4" data-aos="fade-right">
                    <div class="lg:max-w-lg">
                        <h2 class="text-base font-semibold leading-7 c-text-primary uppercase tracking-widest">Enhanced Reading</h2>
                        <p class="mt-2 font-secondary text-3xl font-bold tracking-tight c-text-secondary sm:text-4xl">Your personal library</p>
                        <p class="mt-6 text-lg leading-8 text-gray-400 font-primary">
                            YouLib is designed for enthusiasts who want their digital collection to feel as organized and accessible as a physical library.
                        </p>
                        <dl class="mt-10 max-w-xl space-y-8 text-base leading-7 text-gray-400 lg:max-w-none">
                            <div class="relative pl-9">
                                <dt class="inline font-semibold c-text-secondary">
                                    <svg class="absolute left-1 top-1 h-5 w-5 c-text-primary" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M5.5 17a4.5 4.5 0 01-1.44-8.765 4.5 4.5 0 018.302-3.046 3.5 3.5 0 014.504 4.272 4.5 4.5 0 01-5.366 5.839L11 17.25a.75.75 0 001.5 0V14a.75.75 0 01.75-.75h.75a.75.75 0 010 1.5h-.375v1.5a2.25 2.25 0 01-4.5 0v-1.5H8.625a.75.75 0 010-1.5h.75a.75.75 0 01.75.75v3.25z" clip-rule="evenodd" />
                                    </svg>
                                    Cloud-Ready Uploads.
                                </dt>
                                <dd class="inline">Easily upload your PDF, EPUB, and PPTX files and access them from anywhere.</dd>
                            </div>
                            <div class="relative pl-9">
                                <dt class="inline font-semibold c-text-secondary">
                                    <svg class="absolute left-1 top-1 h-5 w-5 c-text-primary" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path d="M10 12.5a2.5 2.5 0 100-5 2.5 2.5 0 000 5z" />
                                        <path fill-rule="evenodd" d="M.664 10.59a1.651 1.651 0 010-1.186A10.004 10.004 0 0110 3c4.257 0 7.893 2.66 9.336 6.41.147.381.146.804 0 1.186A10.004 10.004 0 0110 17c-4.257 0-7.893-2.66-9.336-6.41zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                    </svg>
                                    Seamless Preview.
                                </dt>
                                <dd class="inline">Read your books directly in the browser with our integrated visualizers.</dd>
                            </div>
                            <div class="relative pl-9">
                                <dt class="inline font-semibold c-text-secondary">
                                    <svg class="absolute left-1 top-1 h-5 w-5 c-text-primary" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M2 3.5A1.5 1.5 0 013.5 2h9A1.5 1.5 0 0114 3.5v11.75c0 .414-.336.75-.75.75h-9a.75.75 0 010-1.5h8.25V3.5h-8.25v10.25H3.5a1.5 1.5 0 01-1.5-1.5V3.5zM4.5 5.5a.75.75 0 000 1.5h4.5a.75.75 0 000-1.5h-4.5zM4.5 8.5a.75.75 0 000 1.5h4.5a.75.75 0 000-1.5h-4.5z" clip-rule="evenodd" />
                                    </svg>
                                    Smart Categorization.
                                </dt>
                                <dd class="inline">Keep your library tidy by tagging books with categories for quick filtering.</dd>
                            </div>
                        </dl>
                    </div>
                </div>
                <div class="flex items-start justify-end lg:order-last" data-aos="fade-left">

                    <img src="{{ asset('img/welcomepic.jpeg') }}" alt="library image" class="img-fluid rounded-xl >
                </div>
            </div>
        </div>
    </div>
</x-layout>