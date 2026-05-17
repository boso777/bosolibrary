    <!DOCTYPE html>
    <html lang="it">
    
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ $book->title }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/ebook-reader.js'])
        <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
        @livewireStyles
        
        @if($extension == 'epub')
        <style>
            html, body {
                margin: 0;
                padding: 0;
                height: 100%;
                overflow: hidden;
            }
            
            /* Il contenitore fa da perno per il posizionamento dei bottoni */
            #viewer-container {
                position: relative; 
                width: 100vw;
                height: calc(100vh - 75px); /* Adatta l'altezza in base alla tua navbar */
                background: white;
            }
            
            #viewer {
                width: 100% !important;
                height: 100% !important;
            }
            
            /* Stile comune per le frecce galleggianti */
            .nav-arrow {
                position: absolute;
                top: 50%;
                transform: translateY(-50%); /* Centra perfettamente in verticale */
                z-index: 1000;                  /* Forza il bottone a stare SOPRA l'iframe */
                background: rgba(0, 0, 0, 0.05); /* Sfondo circolare semi-trasparente stile e-reader */
                color: #333;
                border: none;
                width: 15px;
                height: 200px;
                border-radius:10px;
                font-size: 20px;
                cursor: pointer;
                display: flex;
                align-items: center;
                justify-content: center;
                transition: background 0.2s, transform 0.2s;
            }
            
            .nav-arrow:hover {
                background: rgba(0, 0, 0, 0.3);
            }
            
            /* Ancoraggio a Sinistra */
            #prev {
                left: 20px;
            }
            
            /* Ancoraggio a Destra */
            #next {
                right: 20px;
            }
        </style>
        @endif      
    </head>
    
    <body>
        
        <x-navbar></x-navbar>
        
        
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
    </body>
    </html>
    