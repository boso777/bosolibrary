<x-layout>
    <div class="flex flex-col items-center w-full mt-10 px-4 min-h-screen">
        
        <div class="w-full max-w-4xl">
            <nav class="flex mb-8" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3 text-sm font-primary">
                    <li class="inline-flex items-center">
                        <a href="{{ route('home') }}" class="c-text-secondary hover:c-text-primary transition-colors">Home</a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                            </svg>
                            <a href="{{ route('books.index') }}" class="ml-1 md:ml-2 c-text-secondary hover:c-text-primary transition-colors">Library</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                            </svg>
                            <span class="ml-1 md:ml-2 text-gray-500">{{ $book->title }}</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <section class="c-bg-dark border border-gray-800 rounded-3xl shadow-2xl overflow-hidden mb-20">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-0">
                    {{-- Cover side --}}
                    <div class="relative bg-black/40 flex items-center justify-center p-8 md:p-12 border-b md:border-b-0 md:border-r border-gray-800">
                        <div class="relative group">
                            <div class="absolute -inset-1 bg-gradient-to-r from-red-600 to-red-900 rounded-lg blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200"></div>
                            <img src="{{Storage::url($book->cover_image)}}" alt="{{ $book->title }}" class="relative rounded-lg shadow-2xl max-h-[500px] w-auto object-cover transform transition-transform duration-500 group-hover:scale-[1.02]">
                        </div>
                    </div>

                    {{-- Info side --}}
                    <div class="p-8 md:p-12 flex flex-col justify-center">
                        <div class="flex flex-wrap gap-2 mb-6">
                            @foreach ($book->categories as $category)
                                <span class="bg-red-600/10 border border-red-600/20 text-red-500 text-xs font-semibold px-3 py-1 rounded-full uppercase tracking-widest">
                                    {{ $category->name }}
                                </span>
                            @endforeach
                        </div>

                        <h1 class="font-secondary text-3xl md:text-4xl font-bold c-text-secondary mb-4 leading-tight">
                            {{ $book->title }}
                        </h1>

                        <div class="flex items-center gap-4 mb-8">
                            <div class="h-10 w-10 rounded-full c-bg-primary flex items-center justify-center text-white font-bold font-secondary">
                                {{ strtoupper(substr($book->author, 0, 1)) }}
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-widest font-primary">Author</p>
                                <p class="c-text-secondary font-medium">{{ $book->author }}</p>
                            </div>
                        </div>

                        <div class="mb-10">
                            <h3 class="text-xs text-gray-500 uppercase tracking-widest font-primary mb-3">Description</h3>
                            <p class="text-gray-300 leading-relaxed font-primary">
                                {{ $book->description }}
                            </p>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-4 mt-auto">
                            <a href="{{route('books.read' , ['id' => $book->id])}}" 
                               class="inline-flex items-center justify-center px-8 py-4 rounded-full font-bold c-text-secondary border border-gray-700 hover:border-gray-500 transition-all">
                                Read Now
                            </a>
                            <a href="{{ route('books.index') }}" 
                               class="inline-flex items-center justify-center px-8 py-4 rounded-full font-bold c-text-secondary border border-gray-700 hover:border-gray-500 transition-all">
                                Back to Library
                            </a>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-4 mt-4">
                            <a href="{{ route('books.edit' , compact('book')) }}" 
                               class="flex-1 inline-flex items-center justify-center gap-2 c-text-secondary border border-gray-700 hover:border-gray-500 px-8 py-4 rounded-full font-bold transition-all hover:opacity-90 shadow-lg group">
                                Edit
                            </a>
                            <button data-modal-target="delete-modal" data-modal-toggle="delete-modal" type="button" class="inline-flex items-center justify-center px-8 py-4 rounded-full font-bold c-text-secondary border border-gray-700 hover:border-gray-500 transition-allflex-1 inline-flex items-center justify-center gap-2 c-bg-primary c-text-secondary px-8 py-4 rounded-full font-bold transition-all hover:opacity-90 shadow-lg shadow-red-900/20 group">
                                Delete
                            </button>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>


<!-- Delete Modal -->
<div id="delete-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative c-bg-dark border border-gray-800 rounded-2xl shadow-2xl p-6">
            
            <button type="button" data-modal-hide="delete-modal" class="absolute top-3 end-3 text-gray-400 hover:text-white rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6"/>
                </svg>
            </button>

            <div class="text-center pt-4">
                <svg class="mx-auto mb-4 text-gray-500 w-12 h-12" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 13V8m0 8h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                </svg>
                <h3 class="mb-6 text-gray-300 font-primary">Sei sicuro di voler eliminare <span class="text-white font-bold">{{ $book->title }}</span>?</h3>
                
                <div class="flex items-center justify-center gap-4">
                        <a href="{{ route('books.destroy' , compact('book')) }}" class="c-bg-primary hover:opacity-90 text-white text-sm font-bold px-8 py-3 rounded-full transition">
                            Sì, elimina
                        </a>
                    <button data-modal-hide="delete-modal" type="button" class="border border-gray-700 hover:border-gray-500 text-gray-300 text-sm font-bold px-8 py-3 rounded-full transition">
                        Annulla
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>


</x-layout>

