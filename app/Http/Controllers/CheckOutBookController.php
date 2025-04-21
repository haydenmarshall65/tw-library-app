<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\CheckedOutBy;

class CheckOutBookController extends Controller
{
    public function store(Book $book, Request $request)
    {
        // using the book and auth()->user()->id, create a new CheckedOutBy record
        CheckedOutBy::create([
            'book_id' => $book->id,
            'customer_id' => auth()->user()->id,
        ]);

        return response()->noContent();
    }
}
