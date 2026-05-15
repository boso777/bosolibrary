<div class="c-bg-secondary block max-w-sm border border-default rounded-base shadow-xs rounded-2xl">
    <a href="#">
        <img class="rounded-2xl scale-90" src="{{Storage::url($book->cover_image)}}" alt="" />
    </a>
    <div class="p-6 text-center">

        @foreach ($book->categories as $category)
            
        <span class="inline-flex items-center bg-brand-softer border border-brand-subtle text-fg-brand-strong text-xs font-medium px-1.5 py-0.5 rounded-sm">
            {{$category->name}}
        </span>

        @endforeach
        
        <a href="#">
            <h5 class="mt-3 mb-6 text-2xl font-semibold tracking-tight text-heading">{{$book->title}}</h5>
        </a>
        <a href="{{route('books.show', $book)}}" class="inline-flex items-center text-black bg-brand box-border border border-transparent hover:bg-brand-strong focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none">
            See more
            <svg class="w-4 h-4 ms-1.5 rtl:rotate-180 -me-0.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4"/></svg>
        </a>
    </div>
</div>
