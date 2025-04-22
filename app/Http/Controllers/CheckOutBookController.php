<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\CheckedOutBy;
use App\Http\Resources\BookResource;

class CheckOutBookController extends Controller
{
    public function store(Book $book, Request $request)
    {
        // check if the book is already checked out and return an error if so.
        $bookAlreadyCheckedOut = CheckedOutBy::where('book_id', $book->id)->where('customer_id', auth()->user()->id)->first();

        if($bookAlreadyCheckedOut) {
            return response()->json([
                'message' => "\"" . $book->title . "\" is already checked out."
            ], 400);
        }

        // using the book and auth()->user()->id, create a new CheckedOutBy record
        CheckedOutBy::create([
            'book_id' => $book->id,
            'customer_id' => auth()->user()->id,
            'checked_out_at' => now()
        ]);

        $book->refresh();

        return response()->json([
            'book' => BookResource::make($book)
        ]);
    }

    public function update(CheckedOutBy $checkedOutBy, Request $request)
    {
        $checkedOutBy->checked_out_at = null;
        $checkedOutBy->returned_at = now();
        $checkedOutBy->save();

        return response()->json(['checkedOutBy' => $checkedOutBy]);
    }
}
