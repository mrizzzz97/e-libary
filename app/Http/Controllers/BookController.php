<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $title = 'Dashboard | Book';
        $books = Book::paginate(9);

        return view('dashboard.book.index', compact('title', 'books'));
    }

    public function create()
    {
        $title = "Dashboard | Create Book";
        $categories = Category::all();
        $authors = Author::all();

        return view('dashboard.book.create', compact('title', 'categories', 'authors'));
    }
    public function edit(Book $book)
    {
        $title = "Dashboard | Edit Book";
        $categories = Category::all();
        $authors = Author::all();

        return view('dashboard.book.edit', compact('title', 'book', 'categories', 'authors'));
    }
    public function destroy(Book $book)
    {
        Book::destroy($book->id);

        return redirect('/dashboard/book')->with('success', 'Book has been deleted!');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            "name" => "required|max:255",
            "slug" => "required|unique:books",
            "cover" => "required|image|max:1024",
            "body" => "required",
            "published_at" => "date",
            "category_id" => "required",
            "author_id" => "required",
        ]);

        if ($request->file('cover')) {
            $validatedData['cover'] = $request->file('cover')->store('book-covers', 'public');
        }

        Book::create($validatedData);

        return redirect('/dashboard/book')->with("success", "Book created successfully!!");
    }
}