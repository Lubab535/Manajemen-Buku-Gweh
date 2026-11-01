<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

    // Catatan: Field berikut boleh diisi dari form atau controller secara aman.
    protected $fillable = [
        'title',
        'author',
        'publisher',
        'publication_year',
        'description',
    ];
}
