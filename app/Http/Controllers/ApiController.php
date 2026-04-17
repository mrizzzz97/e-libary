<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::all();
        return response()->json($books);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|unique:books',
            'cover' => 'image|max:1024|nullable',
            'body' => 'required',
            'publication_at' => 'date|nullable',
            'category_id' => 'required|exists:categories,id',
            'author_id' => 'required|exists:authors,id',
        ]);

        if ($request->file('cover')) {
            $validatedData['cover'] = $request->file('cover')->store('cover-buku', 'public');
        }

        Book::create($validatedData);

        return response()->json([
            'message' => 'Book created successfully'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $books = Book::find($id);

        if (!$books) {
            return response()->json([
                'message' => 'Book not found'
            ],
            404);
        }

        return response()->json($books);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $books = Book::find($id);

        if (!$books) {
            return response()->json([
                'message' => 'Book not Found!'
            ], 404);
        }

        $rules = [
            'name' => 'sometimes|max:255|string',
            'cover' => 'image|max:1024|sometimes',
            'body' => 'sometimes',
            'publication_at' => 'date|sometimes',
            'category_id' => 'sometimes',
            'author_id' => 'sometimes',
        ];

        if ($request->slug != $books->slug) {
            $rules['slug'] = 'sometimes|unique:books';
        }

        $validatedData = $request->validate($rules);

        if ($request->hasFile('cover')) {
            if ($books->cover && Storage::disk('public')->exists($books->cover)) {
                Storage::disk('public')->delete($books->cover);
            }
            $validatedData['cover'] = $request->file('cover')->store('cover-buku', 'public');
        }

        $books->update($validatedData);

        return response()->json([
            'message' => 'Book updated successfully'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $books = Book::find($id);

        if (!$books) {
            return response()->json([
                'message' => 'Book not Found!'
            ], 404);
        } else {
            if ($books->cover && Storage::disk('public')->exists($books->cover)) {
                Storage::disk('public')->delete($books->cover);
                }
                
            $books->destroy($id);

            return response()->json([
                'message' => 'Book deleted successfully'
            ], 200);
        }

    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|min:3',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->role !== 'admin') {
                Auth::logout();
                return response()->json([
                    'message' => 'Unauthorized, Admin Only'
                ], 403);
            }

            $token = $user->createToken('apitoken')->plainTextToken;

            return response()->json([
                'token' => $token
            ]);
        }

        return response()->json([
            'message' => 'Login Failed'
        ], 401);
    }
}
