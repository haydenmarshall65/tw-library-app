<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Resources\BookResource;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

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
        $request->validate([
            'title' => 'required|string',
            'author' => 'required|string',
            'description' => 'required|string',
            'publisher' => 'required|string',
            'publication_date' => 'required|string',
            'category' => 'required|string',
            'isbn' => 'required|numeric',
            'page_count' => 'required|numeric',
            'new_cover_image' => 'nullable|file|extensions:jpg,png'
        ]);

        $newCoverImage = $request->new_cover_image;
        $newCoverImageName = $newCoverImage->getClientOriginalName();

        $request->file('new_cover_image')->storeAs('images', $newCoverImageName, 'public');

        $book->update([
            'title' => $request->title,
            'author' => $request->author,
            'description' => $request->description,
            'publisher' => $request->publisher,
            'publication_date' => Carbon::parse($request->publication_date)->format('m/d/Y'),
            'isbn' => $request->isbn,
            'page_count' => $request->page_count,
            'cover_image' => asset('/storage/images/'.$newCoverImageName),
        ]);

        return response()->json([
            'book' => $book
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        //
    }
}
