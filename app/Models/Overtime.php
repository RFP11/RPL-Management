<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Overtime extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'overtime_at', 
        'user_id',
        'bonuses' 
    ];


    /**
     * Get the user that owns the Overtime
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
