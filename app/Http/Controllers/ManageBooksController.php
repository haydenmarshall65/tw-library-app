<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Resources\BookResource;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ManageBooksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(! auth()->user()->hasRole('librarian')) {
            return redirect()->to('/');
        }
        $books = BookResource::collection(Book::with('checkedOutBy')->get());

        return Inertia::render('Librarian/ManageBooks', [
            'books' => $books
        ]);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        $book->load(['checkedOutBy']);
        return Inertia::render('Librarian/EditBook', [
            'book' => BookResource::make($book)
        ]);
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
