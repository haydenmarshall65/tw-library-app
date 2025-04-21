<?php

namespace App\Http\Controllers;

use App\Models\CustomerReview;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Http\Resources\BookResource;

class CustomerReviewController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Book $book, Request $request)
    {
        $request->validate([
            'review' => 'required|string',
            'rating' => 'required|numeric'
        ]);

        $review = CustomerReview::create([
            'customer_id' => auth()->user()->id,
            'book_id' => $book->id,
            'review' => $request->review,
            'rating' => $request->rating,
        ]);

        return response()->json(['review' => $review]);
    }

    public function show(Book $book, Request $request)
    {
        $bookReviews = CustomerReview::where('book_id', $book->id)->latest()->get();

        return response()->json(['reviews' => $bookReviews]);
    }
}
