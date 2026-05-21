<?php
namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads; 
use App\Models\Book;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

new class extends Component
{
    
    use WithFileUploads;
    
    public $book;
    public $title;
    public $description;
    public $author;
    // public $categories = [];
    public $AllCategories = [];
    
    public $newImage;
    public $newFile;
    
    protected function rules() {
        return [
        'title' => 'required|string|max:255',
        'newImage' => 'nullable|image|max:10048', // max 10MB, solo immagini
        'newFile' => 'nullable|max:100000', // max 100MB, solo PDF/EPUB
        ];
    }
    
    public function mount(Book $book){
        $this->book = $book;
        $this->title = $book->title;
        $this->description = $book->description;
        $this->author = $book->author;
        // $this->categories = $book->categories->pluck('id')->toArray();    
        // $this->AllCategories = Category::all();
        
        
    }
    
    public function update(){
        
        $this->validate();
        
        $this->book->title = $this->title;
        $this->book->description = $this->description;
        $this->book->author = $this->author;
        
        // gestione immagini
        if($this->newImage){
            Storage::disk('public')->delete($this->book->cover_image);
            $this->book->cover_image = $this->newImage->store('covers', 'public');
        }
        
        
        // gestione file
        if($this->newFile){
                Storage::disk('public')->delete($this->book->attachments->path);
                $this->book->attachments->update(['path' => $this->newFile->store('books', 'public')]);
        }
        
        $this->book->save();
        
        $this->reset(['newImage', 'newFile']);
        
        session()->flash('message', 'Libro aggiornato con successo!');
        
    }
    
    
    
    
    
}
?>

<div>
    {{-- Waste no more time arguing what a good man should be, be one. - Marcus Aurelius --}}
    
    
    <div class='flex justify-content-center align-center max-w-lg max-md:mx-auto c-bg-dark backdrop-blur-sm border border-white/10 rounded-2xl p-8 shadow-2xl'>
        <form class='space-y-6' wire:submit.prevent="update">
            
            @if ($errors->any())
            <div class="bg-red-500/10 border border-red-500 text-red-500 p-4 rounded-lg mb-6">
                <ul class="font-primary text-sm">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            
            @foreach (['success', 'error', 'warning', 'info','message'] as $type)
            @if(session($type))
            <div class="bg-red-500/10 border border-red-600 text-white p-4 rounded-lg mb-6 font-primary text-sm">
                {{ session($type) }}
            </div>
            @endif
            @endforeach
            
            <div>
                <label class='block text-white text-xs uppercase tracking-widest font-semibold mb-2 font-primary'>Title</label>
                <input 
                wire:model="title"
                type="text" 
                placeholder="{{$book->title}}" 
                class='w-full bg-white/5 border border-white/10 rounded-lg px-4 py-3 text-white placeholder:text-gray-500 placeholder:text-sm focus:outline-none focus:border-red-600 transition-all duration-200'
                />
            </div>
            
            <div class="mt-4">
                {{-- <label class="block text-white text-xs uppercase tracking-widest font-semibold mb-2 font-primary">Categories</label> --}}
                
                {{-- <div wire:ignore>
                    <select id="select-categories" multiple placeholder="Choose categories..." autocomplete="on"
                    class="w-full">
                    @foreach($AllCategories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div> --}}
        </div>
        
        <div>
            <label class='block text-white text-xs uppercase tracking-widest font-semibold mb-2 font-primary'>Description</label>
            <textarea 
            wire:model="description"
            placeholder="Short recap of the book" 
            rows="3"
            class='w-full bg-white/5 border border-white/10 rounded-lg px-4 py-3 text-white placeholder:text-gray-500 placeholder:text-sm focus:outline-none focus:border-red-600 transition-all duration-200 resize-none'
            ></textarea>
        </div>
        
        <div>
            <label class='block text-white text-xs uppercase tracking-widest font-semibold mb-2 font-primary'>Author</label>
            <input 
            type="text"
            wire:model="author"
            placeholder="Author of the document" 
            class='w-full bg-white/5 border border-white/10 rounded-lg px-4 py-3 text-white placeholder:text-gray-500 placeholder:text-sm focus:outline-none focus:border-red-600 transition-all duration-200'
            >
        </div>
        
        <div class="flex flex-col gap-y-4 justify-center align-middle">
            
            <div class="flex align-middle justify-center flex-col gap-y-4">
                <div class="flex flex-col gap-y-4 justify-center align-middle">
                    <label class='block text-white text-xs uppercase tracking-widest font-semibold mb-2 font-primary'>Cover Image</label>
                    <img class="block rounded-xl size-10/12" src="{{Storage::url($book->cover_image)}}" alt="cover del libro">
                </div>
            </div>
            
            <div class="">
                <label class='block text-white text-xs uppercase tracking-widest font-semibold mb-2 font-primary'>New Cover Image</label>
                <input 
                wire:model="newImage"
                type="file"  
                accept="image/*"
                class="w-full text-xs text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-2 file:text-xs file:font-semibold file:c-bg-primary file:c-text-secondary hover:file:opacity-90 cursor-pointer"
                />
            </div>
            
            <div>
                <label class='block text-white text-xs uppercase tracking-widest font-semibold mb-2 font-primary'>New Document</label>
                <input 
                wire:model="newFile"
                type="file"  
                class="w-full text-xs text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-2 file:text-xs file:font-semibold file:c-bg-primary file:c-text-secondary hover:file:opacity-90 cursor-pointer"
                />
            </div>
        </div>
        
        <div class='flex items-center justify-end'>
            
            <button type="submit" class='c-bg-primary hover:opacity-90 text-white text-sm font-bold px-10 py-3 rounded-full transition duration-300 cursor-pointer shadow-lg shadow-red-900/20'>
                Publish Book
            </button>
        </div>
    </form>
</div>
</div>