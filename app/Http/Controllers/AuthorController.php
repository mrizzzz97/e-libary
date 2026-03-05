<?php

namespace App\Http\Controllers;

use App\Models\Author;

class AuthorController extends Controller
{
    public function index()
    {
        $title = 'Author';
        $authors = Author::all();
        return view('dashboard.author.index', compact('title', 'authors'));
    }
}
