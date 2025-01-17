<?php

namespace App\Models;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SaveBook extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'book_id'
    ];


    /**
     * Get the user that owns the SaveBook
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


    /**
     * Get the books that owns the SaveBook
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function books()
    {
        return $this->belongsTo(Book::class, 'book_id', 'id');
    }
}
