<?php

namespace App\Http\Controllers;

use App\Models\CustomerReview;
use Illuminate\Http\Request;
use App\Models\Book;

class CustomerReviewController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Book $book, Request $request)
    {
        $request->validate([
            'review' => 'string',
            'rating' => 'numeric'
        ]);

        $review = CustomerReview::create([
            'customer_id' => auth()->user()->id,
            'book_id' => $book->id,
            'review' => $request->review,
            'rating' => $request->rating,
        ]);

        return response()->json(['review' => $review]);
    }
}
