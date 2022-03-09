<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Author;
use App\Models\Genre;

class Book extends Model
{
    use HasFactory;

    protected $table = 'book';

    protected $fillable = [
        'name',
        'author_id',
        'genre_id'
    ];

    public function author() {
        return $this->hasMany(Author::class);
    }

    public function genre() {
        return $this->hasMany(Genre::class);
    }
}
