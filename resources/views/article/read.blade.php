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
        <x-layout>
            <div class=" bg-mauve-900 py-6 mt-10 grid">
                <h2 class="text-center text-red-600 text-xl grid-cols-8">
                    Extension of the document not supported yet! Don't worry, we will fix this soon!
                </h2>
            </div>
        </x-layout>
    @endswitch