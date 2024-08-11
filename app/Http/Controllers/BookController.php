<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade as PDF;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $categoryId = $request->input('category_id');
        $books = Book::when($categoryId, function ($query, $categoryId) {
            return $query->where('category_id', $categoryId);
        })->where(function($query) {
            if (Auth::user()->role !== 'admin') {
                $query->where('user_id', Auth::id());
            }
        })->get();

        $categories = Category::all();
        return view('books.index', compact('books', 'categories'));
    }

    public function show(Book $book)
    {
        $this->authorize('view', $book);
        return view('books.show', compact('book'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('books.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'quantity' => 'required|integer',
            'book_file' => 'nullable|mimes:pdf|max:1048576',
            'cover_image' => 'required|mimes:jpeg,jpg,png|max:1024',
        ]);

        $bookFile = $request->hasFile('book_file') ? $request->file('book_file')->store('books') : null;
        $coverImage = $request->file('cover_image')->store('covers');

        Book::create([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'book_file' => $bookFile,
            'cover_image' => $coverImage,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('books.index')->with('success', 'Book created successfully.');
    }

    public function edit(Book $book)
    {
        $this->authorize('update', $book);
        $categories = Category::all();
        return view('books.edit', compact('book', 'categories'));
    }

    public function update(Request $request, Book $book)
    {
        $this->authorize('update', $book);

        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'quantity' => 'required|integer',
            'book_file' => 'nullable|mimes:pdf|max:2048',
            'cover_image' => 'nullable|mimes:jpeg,jpg,png|max:1024',
        ]);

        if ($request->hasFile('book_file')) {
            Storage::delete($book->book_file);
            $book->book_file = $request->file('book_file')->store('books');
        }

        if ($request->hasFile('cover_image')) {
            Storage::delete($book->cover_image);
            $book->cover_image = $request->file('cover_image')->store('covers');
        }

        $book->update($request->only('title', 'category_id', 'description', 'quantity'));

        return redirect()->route('books.index')->with('success', 'Book updated successfully.');
    }

    public function destroy(Book $book)
    {
        $this->authorize('delete', $book);

        Storage::delete($book->book_file);
        Storage::delete($book->cover_image);
        $book->delete();

        return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
    }
}
