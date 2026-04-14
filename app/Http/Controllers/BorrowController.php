<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrow;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class BorrowController extends Controller
{
    public function index()
    {
        $title = 'Borrow';
        $borrows = Borrow::latest()->paginate(9);

        return view('dashboard.borrow.index', compact('borrows', 'title'));
    }
    
    public function store(Request $request)
    {
        $borrowDate = Carbon::today();
        $dueDate = $borrowDate->copy()->addDays(7);

        Borrow::create([
            'user_id' => $request->user_id,
            'book_id' => $request->book_id,
            'borrow_date' => $borrowDate,    
            'due_date' => $dueDate,
            'status' => 'diajukan',
        ]);
        // return dd($request->all());

        $book = Book::find($request->book_id);
        $book->status = 1;
        $book->save();

        $user = User::find($request->user_id);

        return redirect()->route('borrow.user', $user->slug)->with('success', 'Borrow added successfully');
    }

    public function edit(Borrow $borrow)
    {
        $title = 'Borrow | Edit';
        return view('dashboard.borrow.edit', compact('borrow', 'title'));
    }

    public function update(Request $request, Borrow $borrow)
    {
        $borrow->status = $request->status;
        if ($request->filled('message')) {
            $borrow->message = $request->message;
        }

        $borrow->save();

        $book = Book::find($borrow->book_id);
        if ($request->status == 'dipinjam' || $request->status == 'diajukan') {
            $book->status = 1;
            $book->save();
        } elseif ($request->status == 'dikembalikan' || $request->status == 'ditolak') {
            $book->status = 0;
            $book->save();
        }

        return redirect('/dashboard/borrow')->with('success', 'Borrow updated successfully');
    }

    public function destroy(Borrow $borrow)
    {
        $borrow->delete();
        return redirect('/dashboard/borrow')->with('success', 'Borrow deleted successfully');
    }

    public function userIndex(User $user)
    {
        $title = $user->name . ' Borrows';
        $borrows = Borrow::where('user_id', $user->id)->latest()->paginate(9);
        return view('borrow', compact('borrows', 'title'));
    }

    public function detail(Borrow $borrow)
    {
        $title = 'Borrow Detail';

        return view('borrow-detail', compact('borrow', 'title'));
    }
}
