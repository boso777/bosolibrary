<?php

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Book;
use App\Models\Category;

new class extends Component
{
    use WithFileUploads;
    
    public $documents = [];
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
        'documents.*' => 'mimes:pdf,epub,txt,rtf,odt,doc,docx,ppt,pptx,odp',
        'title' => 'required|min:3',
        'description' => 'required',
        'author' => 'required',
        'selected_categories' => 'required|array',
        'cover_image' => 'nullable|image|mimes:jpeg,png,avif,webp|max:512000',
        'documents' => 'required|array|min:1',
        'documents.*' => 'mimes:pdf,epub,txt,rtf,odt,doc,docx,ppt,pptx,odp',
        ]);
        
        // 2. Upload Immagine
        $coverPath = $this->cover_image ? $this->cover_image->store('covers', 'public') : null;
        
        // 3. Creazione Libro (senza categorie)
        $book = Book::create([
        'title' => $this->title,
        'description' => $this->description,
        'author' => $this->author,
        'cover_image' => $coverPath,
        'user_id' => auth()->id()
        ]);
        
        foreach ($this->documents as $pdf) {
            $path_doc = $pdf->store('books/documents', 'public');
            
            $book->attachments()->create([
            'path' => $path_doc,
            'name' => $pdf->getClientOriginalName(),
            ]);
        }
        
        
        $book->categories()->attach($this->selected_categories);
        
        session()->flash('message', 'Libro creato con successo.');
        return redirect()->to('/');
        
        $this->reset();
        
    }
    
    
    
    
};
?>

<div>
    
    {{-- Order your soul. Reduce your wants. - Augustine --}}
    
    <div class='flex justify-content-center align-center max-w-lg max-md:mx-auto bg-[#00A63E]/0 backdrop-blur-sm border border-white/10 rounded-xl p-8'>
        <form class='space-y-6' wire:submit.prevent="save">
            
            @if ($errors->any())
    <div class="bg-red-500/10 border border-red-500 text-red-500 p-4 rounded-lg mb-6">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

            <div>
                <label class='block text-white text-sm mb-2'>Title</label>
                <input 
                wire:model="title"
                type="text" 
                placeholder="Insert Book Title" 
                class='w-full bg-[#00A63E]/5 border border-white/20 rounded-lg px-4 py-3 text-white/40 placeholder:text-white/40 placeholder:text-sm focus:outline-none focus:border-green-600 transition'
                />
            </div>
            
            <div>
                <label class='block text-white text-sm mb-2'>Categories</label>
                <div class="grid grid-cols-2 gap-2">
                    @foreach($categories as $category)
                    <label class="flex items-center text-white/60 text-sm">
                        <input type="checkbox" wire:model="selected_categories" value="{{ $category->id }}" class="mr-2">
                        {{ $category->name }}
                    </label>
                    @endforeach
                </div>
            </div>
            
            <div>
                <label class='block text-white text-sm mb-2'>Recap</label>
                <input 
                wire:model="description"
                type="text" 
                placeholder="Short recap of the book" 
                class='w-full bg-[#00A63E]/5 border border-white/20 rounded-lg px-4 py-3 text-white/40 placeholder:text-white/40 placeholder:text-sm focus:outline-none focus:border-green-600 transition'
                />
            </div>
            
            <div>
                <label class='block text-white text-sm mb-2'>Author</label>
                <textarea 
                wire:model="author"
                placeholder="Author of the document" 
                rows="4"
                class='w-full bg-[#00A63E]/5 border border-white/20 rounded-lg px-4 py-3 text-white/40 placeholder:text-white/40 placeholder:text-sm focus:outline-none focus:border-green-600 transition resize-none'
                ></textarea>
            </div>
            
            <div>
                <label class='block text-white text-sm mb-2'>Cover img</label>
                <input 
                wire:model="cover_image"
                type="file"  
                accept="image/jpeg, image/png, image/avif, image/webp"
                class="w-full bg-[#00A63E]/5 border border-white/20 rounded-lg px-4 py-3 text-white/40 focus:outline-none focus:border-green-600 transition"
                />
            </div>
            
            <div>
                <label class='block text-white text-sm mb-2'>Files</label>
                <input 
                wire:model="documents"
                type="file"  
                multiple
                class="w-full bg-[#00A63E]/5 border border-white/20 rounded-lg px-4 py-3 text-white/40 focus:outline-none focus:border-green-600 transition"
                />
            </div>
            
            <div class='flex items-center justify-between'>
                <p class='text-xs md:text-sm text-white/60 max-w-3xs'>
                    By submitting, you agree to our <span class='text-white'>Terms</span> and <span class='text-white'>Privacy Policy</span>.
                </p>
                <button type="submit" class='bg-linear-to-r from-green-950 to-green-600 hover:from-green-600 hover:to-green-950 text-white text-sm px-8 md:px-16 py-3 rounded-full transition duration-300 cursor-pointer'>
                    Submit
                </button>
            </div>
        </form>
    </div>
</div>
