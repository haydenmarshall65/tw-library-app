<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\CustomerReview;
use App\Http\Resources\BookResource;
use Inertia\Inertia;

class BookReviewController extends Controller
{

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return Inertia::render('BookReviews', [
            'book' => BookResource::make($book),
        ]);
    }
}
