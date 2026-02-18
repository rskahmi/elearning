<?php

namespace App\Models;

use App\Traits\UuidTraits;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class CourseModel extends Model
{
    use HasFactory, UuidTraits;
    protected $table = 'course';
    protected $fillable = [
        'nama',
        'deskripsi',
        'user_id'
    ];

    public function dosen(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function mahasiswa(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'course_id',
            'user_id'
        );
    }

    public function discussions()
    {
        return $this->hasMany(DiscussionModel::class);
    }

    public function assignments()
    {
        return $this->hasMany(AssignmentModel::class, 'course_id');
    }


}
