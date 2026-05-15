<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

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
        $book = Book::find($id);
        return view('article.read' , compact('book'));
    }
}