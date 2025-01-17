<?php

namespace App\Models;

use App\Models\User;
use App\Models\SaveBook;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'title', 
        'filename', 
        'filetype', 
        'user_id'
    ];


    /**
     * Get the user that owns the Book
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


    /**
     * Get all of the save_book for the Book
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function save_book()
    {
        return $this->hasMany(SaveBook::class, 'book_id', 'id');
    }
}

