<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'books';

    protected $guarded = ['id'];

    public function checkedOutBy()
    {
        return $this->hasOne(\App\Models\CheckedOutBy::class);
    }

    public function customerReviews()
    {
        return $this->hasMany(\App\Models\CustomerReview::class);
    }
}
