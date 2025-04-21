<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerReview extends Model
{
    protected $guarded = ['id'];

    public function book()
    {
        return $this->belongsTo(\App\Models\Book::class);
    }

    public function customer()
    {
        return $this->belongsTo(\App\Models\User::class, 'customer_id', 'id');
    }
}
