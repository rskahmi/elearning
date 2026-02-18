<?php

namespace App\Models;

use App\Models\SubmissionModel;
use App\Traits\UuidTraits;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignmentModel extends Model
{
    use HasFactory, UuidTraits;
    protected $table = 'assignment';
    protected $fillable = [
        'title',
        'description',
        'deadline',
        'course_id'
    ];

    public function course()
    {
        return $this->belongsTo(CourseModel::class, 'course_id');
    }

    public function submissions()
    {
        return $this->hasMany(SubmissionModel::class);
    }
}
