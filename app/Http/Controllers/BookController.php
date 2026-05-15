<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BookController extends Controller
{
    public function home(){
        return view('welcome');
    }

    public function index()
    {
    // Recupera solo i libri dell'utente attualmente autenticato
    $books = Book::with('categories')->where('user_id', auth()->id())->orderBy('created_at', 'desc')->get();
    return view('article.index', compact('books'));
    }

    public function create()
    {
        return view('article.create');
    }

    public function show(Book $book)
    {
        return view('article.show' , compact('book'));
    }

    public function read($id)
{
    $book = Book::findOrFail($id);

    $path = $book->attachments?->path;

    $extension = $path ? File::extension($path) : null;

    
    return view('article.read', compact('book', 'extension'));
}
}