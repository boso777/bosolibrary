<x-layout>
    <div class="flex flex-col items-center w-full mt-10 px-4">
        
        <h1 class="text-white text-2xl mb-5">{{ $book->title }}</h1>
        
        <section class="bg-white dark:bg-gray-900 rounded-2xl shadow-2xl px-12 py-12">
            <div class="max-w-screen-xl px-2 py-8 mx-auto text-center lg:py-6 lg:px-6">
               
                <figure class="">
                    <div class="flex justify-center align-center pb-5">
                    <img src="{{Storage::url($book->cover_image)}}" alt="">
                    </div>
                    
                    <blockquote class="mt-6">
                        <p class="text-2xl font-medium text-gray-900 dark:text-white">" {{$book->description}}"</p>
                    </blockquote>

                    <figcaption class="flex items-center justify-center mt-6 space-x-3">
                        <div class="flex items-center divide-x-2 divide-gray-500 dark:divide-gray-700">
                            <div class="pr-3 font-medium text-gray-900 dark:text-white">Author</div>
                            <div class="pl-3 text-sm font-light text-gray-500 dark:text-gray-400">{{$book->author}}</div>
                        </div>
                    </figcaption>

                <div class="flex items-center justify-center mt-6 space-x-3">
                    <a class="text-blue-950 bg-blue-200 p-2 rounded-xl" href="{{route('books.read' , ['id' => $book->id])}}">Read now</a>
                </div>

                </figure>
            
            </div>
        </section>
        
    </div>
</x-layout>