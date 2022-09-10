<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RatingResource;
use App\Models\Book;
use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{

    public function store(Request $request, Book $book)
    {
        try {
            $rating = Rating::firstOrCreate(
                [
                    'user_id' => $request->user()->id,
                    'book_id' => $book->id,
                ],
                ['rating' => $request->rating]
            );

            $rat = new RatingResource($rating);

            return response()->json(['success' => 'Thank you for your rating!']);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th], 401);
        }
    }
}
