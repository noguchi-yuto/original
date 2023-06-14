<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'book_title',
        'book_display',
        'book_number',
    ];
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
