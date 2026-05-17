<?php

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Book;
use App\Models\Category;

new class extends Component
{
    use WithFileUploads;
    
    public $document;
    public $title;
    public $description;
    public $author;
    public $selected_categories = [];
    public $cover_image;
    public $categories; // Passi le categorie alla vista;
    
    
    public function mount(){
        $this->categories = Category::all();
    }
    
    public function testClick()
    {
        dd('Livewire funziona');
    }
    
    public function save(){
        
        $this->validate([
        'document.*' => 'mimes:pdf,epub,txt,rtf,odt,doc,docx,ppt,pptx,odp',
        'title' => 'required|min:3',
        'description' => 'required',
        'author' => 'required',
        'selected_categories' => 'required|array',
        'cover_image' => 'nullable|image|mimes:jpeg,png,avif,webp|max:512000',
        'document' => 'required|min:1',
        'document.*' => 'mimes:pdf,epub,txt,rtf,odt,doc,docx,ppt,pptx,odp',
        ]);
        
        // 2. Upload Immagine
        $coverPath = $this->cover_image ? $this->cover_image->store('covers', 'public') : null;
        
        // 3. Creazione Libro (senza categorie)
        $book = Book::create([
        'title' => $this->title,
        'description' => $this->description,
        'author' => $this->author,
        'cover_image' => $coverPath,
        'user_id' => auth()->id(),
        ]);
        
        $path_doc = $this->document->store('books/documents', 'public');
            
        $book->attachments()->create(['path' => $path_doc, 'name' => $this->document->getClientOriginalName(),]);
        
        
        $book->categories()->attach($this->selected_categories);
        
        session()->flash('message', 'Libro creato con successo.');
        return redirect()->to('/');
        
        $this->reset();
        
    }
    
    
    
    
};
?>

<div>
    
    {{-- Order your soul. Reduce your wants. - Augustine --}}
    
    <div class='flex justify-content-center align-center max-w-lg max-md:mx-auto c-bg-dark backdrop-blur-sm border border-white/10 rounded-2xl p-8 shadow-2xl'>
        <form class='space-y-6' wire:submit.prevent="save">
            
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
                placeholder="Insert Book Title" 
                class='w-full bg-white/5 border border-white/10 rounded-lg px-4 py-3 text-white placeholder:text-gray-500 placeholder:text-sm focus:outline-none focus:border-red-600 transition-all duration-200'
                />
            </div>
            
            <div class="mt-4">
                <label class="block text-white text-xs uppercase tracking-widest font-semibold mb-2 font-primary">Categories</label>
                
                <div wire:ignore>
                    <select id="select-categories" multiple placeholder="Choose categories..." autocomplete="on"
                    class="w-full">
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
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
        
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class='block text-white text-xs uppercase tracking-widest font-semibold mb-2 font-primary'>Cover Image</label>
                <input 
                wire:model="cover_image"
                type="file"  
                accept="image/*"
                class="w-full text-xs text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:c-bg-primary file:c-text-secondary hover:file:opacity-90 cursor-pointer"
                />
            </div>
            
            <div>
                <label class='block text-white text-xs uppercase tracking-widest font-semibold mb-2 font-primary'>Document</label>
                <input 
                wire:model="document"
                type="file"  
                class="w-full text-xs text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:c-bg-primary file:c-text-secondary hover:file:opacity-90 cursor-pointer"
                />
            </div>
        </div>
        
        <div class='flex items-center justify-between pt-4 border-t border-white/5'>
            <p class='text-[10px] text-white/40 max-w-[150px] font-primary'>
                By submitting, you agree to our <span class='text-white/60'>Terms</span> and <span class='text-white/60'>Privacy Policy</span>.
            </p>
            <button type="submit" class='c-bg-primary hover:opacity-90 text-white text-sm font-bold px-10 py-3 rounded-full transition duration-300 cursor-pointer shadow-lg shadow-red-900/20'>
                Publish Book
            </button>
        </div>
    </form>
</div>
</div>
