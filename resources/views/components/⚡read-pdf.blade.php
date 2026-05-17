<?php

use Livewire\Component;

new class extends Component {
    public $book;
};
?>

    
    <div class="h-screen mt-2 relative">
        {{-- Let all your things have their places; let each part of your business have its time. - Benjamin Franklin --}}
        <iframe src="{{ Storage::url($book->attachments->path) }}" width="100%" height="100%" allowfullscreen
            frameborder="0">
        </iframe>
        <div class="absolute bottom-10 left-10">
            <a href="#" onclick="history.back(); return false;"
                class="c-bg-primary c-text-secondary font-bold py-3 px-8 rounded-full shadow-lg hover:opacity-90 transition-all duration-200 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to Library
            </a>
        </div>
    </div>

