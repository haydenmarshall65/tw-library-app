<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Http\Resources\BookResource;
use Inertia\Inertia;

class BookSearchController extends Controller
{
    public function search(Request $request)
    {
        $searchTitle = $request->get('searchTitle');

        $matchingBooks = Book::whereLike('title', '%'.$searchTitle.'%')->get();

        if($matchingBooks->count() === 0) {
            return Inertia::render('SearchResults', ['message' => 'No books were found matching "'.$searchTitle.'".']);
        } else {
            return Inertia::render('SearchResults', [
                'books' => BookResource::collection($matchingBooks)
            ]);
        }
    }
}
