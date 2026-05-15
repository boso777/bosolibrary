<x-layout>
    @switch($extension)
        @case('pdf')
            <livewire:read-pdf :book="$book"></livewire:read-pdf>
            @break

        @case('epub')
            <livewire:read-epub :book="$book"></livewire:read-epub>
            @break

        @case('pttx')
            <livewire:read-pptx :book="$book"></livewire:read-pptx>
            @break
        
        @default
            <div class="text-center bg-gray">
                <h2 class="text-red-600">
                    Extension of the document not supported yet! Don't worry, we will fix this soon!
                </h2>
            </div>
    @endswitch  

</x-layout>