<?php

use Livewire\Component;

new class extends Component
{
    public $book;
};
?>

<div>
    {{-- Waste no more time arguing what a good man should be, be one. - Marcus Aurelius --}}
   


    <div>
    <div id="viewer-container" class="epub-container mt-0">
    
        <button id="prev" class="nav-arrow"></button>
        
        <div id="viewer" data-url="{{ Storage::url($book->attachments->path) }}"></div>
        
        <button id="next" class="nav-arrow"></button>

    </div>
</div>




</div>