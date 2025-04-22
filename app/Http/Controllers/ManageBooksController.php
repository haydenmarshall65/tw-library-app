<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Resources\BookResource;
use Illuminate\Http\Request;
use App\Http\Requests\ManageBooksRequest;
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
        return Inertia::render('Librarian/NewBook');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ManageBooksRequest $request)
    {
        $newCoverImage = $request->new_cover_image;
        $cover_image = null;
        if($newCoverImage) {
            $newCoverImageName = $newCoverImage->getClientOriginalName();

            $request->file('new_cover_image')->storeAs('images', $newCoverImageName, 'public');

            $cover_image = asset('/storage/images/'.$newCoverImageName);
        }

        $book = Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'description' => $request->description,
            'publisher' => $request->publisher,
            'publication_date' => Carbon::parse($request->publication_date)->format('m/d/Y'),
            'category' => $request->category,
            'isbn' => $request->isbn,
            'page_count' => $request->page_count,
            'cover_image' => $cover_image,
        ]);

        return response()->json([
            'book' => BookResource::make($book)
        ]);
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
    public function update(ManageBooksRequest $request, Book $book)
    {
        $newCoverImage = $request->new_cover_image;
        $cover_image = null;
        if($newCoverImage) {
            $newCoverImageName = $newCoverImage->getClientOriginalName();

            $request->file('new_cover_image')->storeAs('images', $newCoverImageName, 'public');

            $cover_image = asset('/storage/images/'.$newCoverImageName);
        }

        $book->update([
            'title' => $request->title,
            'author' => $request->author,
            'description' => $request->description,
            'publisher' => $request->publisher,
            'publication_date' => Carbon::parse($request->publication_date)->format('m/d/Y'),
            'category' => $request->category,
            'isbn' => $request->isbn,
            'page_count' => $request->page_count,
            'cover_image' => $cover_image,
        ]);

        return response()->json([
            'book' => BookResource::make($book)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return response()->noContent();
    }
}
