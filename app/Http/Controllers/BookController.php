<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function home()
    {
        $latestBooks = auth()->check() ? Book::with('categories')
            ->where('user_id', auth()->id())
            ->latest()
            ->take(4)
            ->get()
            : collect();

        return view('welcome', compact('latestBooks'));
    }

    public function index()
    {
        $books = Book::with('categories')
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(6);

        return view('article.index', compact('books'));
    }

    public function create()
    {
        return view('article.create');
    }

    public function show(Book $book)
    {
        return view('article.show', compact('book'));
    }

    public function read($id)
    {
        $book = Book::findOrFail($id);

        $path = $book->attachments?->path;

        $extension = $path ? File::extension($path) : null;

        return view('article.read', compact('book', 'extension'));
    }

    public function delete($book){
        
        $book = Book::findOrFail($book);

        if ($book->attachments) {
        if (Storage::disk('public')->exists($book->attachments->path)) {
            Storage::disk('public')->delete($book->attachments->path);
        }
        }
        
        Storage::disk('public')->delete($book->cover_image);
        
        $book->attachments->delete();
        $book->delete();
        
        return redirect()->to('index')->with('message', 'Libro eliminato con successo.');
    }

    public function edit($book){
        
        return view('article.edit', compact('book'));
    }

    
}
