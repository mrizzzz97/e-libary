<?php

namespace App\Http\Controllers;
use App\Models\Book;
use App\Models\Category;
use App\Models\Author;
class HallController extends Controller
{
    public function index()
    {
        $title = '';
        if (request('category')) {
            $category = Category::where('slug', request('category'))->first();
            $title = 'of ' . $category->name;
        }

        if (request('author')) {
            $author = Author::where('slug', request('author'))->first();
            $title = 'of ' . $author->name;
        }

        $title = 'Hall ' . $title;

        $books = Book::latest()
            ->search(request()->only(['search', 'category', 'author']))
            ->paginate(10)
            ->withQueryString();

        return view('hall', compact('title', 'books'));
    }
    public function singleBook(Book $book)
    {
        $title = $book->name;

        return view('book', compact('title', 'book'));
    }
}



