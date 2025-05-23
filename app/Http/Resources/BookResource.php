<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $averageRating = 0;
        $ratingSum = 0;
        $reviews = $this->customerReviews()->get();
        if($reviews->count() > 0) {
            foreach ($reviews as $review) {
                $ratingSum += $review->rating;
            }
            $averageRating = round($ratingSum / $reviews->count(), 1);
        }
        return [
            'id' => $this->id,
            'title' => $this->title,
            'author' => $this->author,
            'description' => $this->description,
            'cover_image' => $this->cover_image,
            'publisher' => $this->publisher,
            'publication_date' => Carbon::parse($this->publication_date)->format('m/d/Y'),
            'category' => $this->category,
            'isbn' => $this->isbn,
            'page_count' => $this->page_count,
            'checked_out_by' => $this->whenLoaded('checkedOutBy'),
            'customer_reviews' => $this->whenLoaded('customerReviews'),
            'has_reviews' => $this->whenLoaded('customerReviews', $this->customerReviews->count() === 0),
            'is_checked_out' => $this->whenLoaded('checkedOutBy', $this->checkedOutBy !== null),
            'filter_on' => false,
            'average_rating' => $averageRating,
        ];
    }
}
