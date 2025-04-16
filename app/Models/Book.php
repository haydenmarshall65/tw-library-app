<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $guarded = ['id'];

    public function checkedOutBy()
    {
        return $this->hasMany(\App\Models\CheckedOutBy::class);
    }
}
