<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id',
        'user_id',
        'rating'
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
