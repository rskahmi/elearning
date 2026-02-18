<?php

namespace App\Models;

use App\Traits\UuidTraits;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, UuidTraits, softDeletes;

    protected $table = "users";
    protected $fillable = [
        'nama',
        'email',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
    ];

    public function coursesMengajar(): HasMany
    {
        return $this->hasMany(CourseModel::class, 'dosen_id');
    }

    public function coursesDiikuti(): BelongsToMany
    {
        return $this->belongsToMany(
            CourseModel::class,
            'user_id',       // foreign key di pivot
            'course_id'      // related key di pivot
        );
    }

    // User punya banyak Discussion
public function discussions()
{
    return $this->hasMany(Discussion::class);
}

// User punya banyak Reply
public function replies()
{
    return $this->hasMany(Reply::class);
}

}
