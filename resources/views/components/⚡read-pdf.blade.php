<?php

use Livewire\Component;

new class extends Component
{
    public $book; 
};
?>

<div>
    {{-- Let all your things have their places; let each part of your business have its time. - Benjamin Franklin --}}
    <h2 class="text-white font-semibold text-3xl text-center mt-10">{{$this->book->title}}</h1>
    <iframe src="{{Storage::url($book->attachments->path)}}" width="100%" height="500px"></iframe>
</div>