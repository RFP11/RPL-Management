<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Book;
use App\Models\Task;
use App\Models\Salary;
use App\Models\Subject;
use App\Models\Overtime;
use App\Models\SaveBook;
use App\Models\UserType;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_type_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    /**
     * Get all of the overtimes for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function overtimes()
    {
        return $this->hasMany(Overtime::class, 'user_id', 'id');
    }
    
    /**
     * Get the salary associated with the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function salary()
    {
        return $this->hasOne(Salary::class, 'user_id', 'id');
    }

    
    /**
     * Get the user_type that owns the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user_type()
    {
        return $this->belongsTo(UserType::class, 'user_type_id');
    }

    /**
     * Get all of the subjects for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subjects()
    {
        return $this->hasMany(Subject::class, 'user_id', 'id');
    }


    /**
     * Get all of the tasks for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tasks()
    {
        return $this->hasMany(Task::class, 'user_id', 'id');
    }


    /**
     * Get all of the books for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function books()
    {
        return $this->hasMany(Book::class, 'user_id', 'id');
    }


    /**
     * Get all of the save_book for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function save_books()
    {
        return $this->hasMany(SaveBook::class, 'user_id', 'id');
    }
}
