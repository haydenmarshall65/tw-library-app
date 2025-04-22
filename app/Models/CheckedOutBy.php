<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CheckedOutBy extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'checked_out_at' => 'date',
        'returned_at' => 'date'
    ];

    protected $database = 'main';
    protected $table = 'checked_out_by';

    public function book()
    {
        return $this->belongsTo(\App\Models\Book::class);
    }
}
