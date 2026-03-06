<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        $title = 'Author';
        $authors = Author::all();
        return view('dashboard.author.index', compact('title', 'authors'));
    }

    public function create()
    {
        $title = 'Author | Create';
        return view('dashboard.author.create', compact('title'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'slug' => 'required|unique:authors',
        ]);

        Author::create($validatedData);

        return redirect('/dashboard/author')->with('success', 'New author has been added!');
    }
    
    public function edit(Author $author)
    {
        $title = 'Author | Edit';
        return view('dashboard.author.edit', compact('title', 'author'));
    }


    public function update(Request $request, Author $author)
    {
        $rules = [
            "name" => "required|max:255",
        ];

        if ($request->slug != $author->slug) {
            $rules['slug'] = 'required|unique:categories';
        }

        $validatedData = $request->validate($rules);

        Author::where('id', $author->id)->update($validatedData);

        return redirect('/dashboard/author')->with('success', 'Author has been updated!');
    }   

    public function destroy(Author $author)
    {
        Author::destroy($author->id);
        return redirect('/dashboard/author')->with('success', 'Author has been deleted!');
    }
}
