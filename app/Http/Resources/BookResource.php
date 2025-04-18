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
        return [
            'id' => $this->id,
            'title' => $this->title,
            'author' => $this->author,
            'description' => $this->description,
            'cover_image' => $this->cover_image,
            'publisher' => $this->publisher,
            'publication_date' => Carbon::parse($this->publication_date)->format('MM/DD/YYYY'),
            'category' => $this->category,
            'isbn' => $this->isbn,
            'page_count' => $this->page_count,
            'checked_out_by' => $this->whenLoaded('checkedOutBy'),
            'filter_on' => false,
        ];
    }
}
