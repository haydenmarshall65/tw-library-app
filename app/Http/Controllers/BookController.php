<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Resources\BookResource;
use Inertia\Inertia;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(BookResource::collection(Book::with(['checkedOutBy', 'customerReviews'])->get()));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // todo in step 7
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // todo in step 7
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return Inertia::render('BookDetails', [
            'book' => BookResource::make($book)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        //
    }
}
