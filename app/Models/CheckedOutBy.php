<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CheckedOutBy extends Model
{
    protected $guarded = ['id'];

    public function book()
    {
        return $this->belongsTo(\App\Models\Book::class);
    }
}
