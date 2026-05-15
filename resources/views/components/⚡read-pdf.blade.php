<?php

use Livewire\Component;

new class extends Component {
    public $book;
};
?>

<div>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>BosoLibrary</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles 
        <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
    </head>
    <body>
        
    </body>
    </html>
    {{-- Let all your things have their places; let each part of your business have its time. - Benjamin Franklin --}}
    <iframe src="{{ Storage::url($book->attachments->path) }}" width="100%" height="100%" allowfullscreen
        frameborder="0"></iframe>
    <div class="inline-flex">
        <a href="#" onclick="history.back(); return false;"
            class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-r">Indietro</a>

    </div>
</div>
