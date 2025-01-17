<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserType extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    /**
     * Get all of the user for the UserType
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function user()
    {
        return $this->hasMany(User::class, 'user_type_id', 'id');
    }
}
