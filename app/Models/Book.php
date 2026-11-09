<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    /** @var list<string> */
    protected $fillable = [
        'title',
        'author',
        'publisher',
        'publication_year',
        'description',
        'image',
    ];

    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn ($image) => url('/storage/books/' . ltrim($image, '/')),
        );
    }
}
