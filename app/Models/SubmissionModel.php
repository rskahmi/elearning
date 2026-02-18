<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubmissionModel extends Model
{
    protected $table = 'submissions'; // sesuai migration
    protected $fillable = ['file_path', 'score', 'assignment_id', 'user_id'];

    public function assignment()
    {
        return $this->belongsTo(AssignmentModel::class, 'assignment_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
