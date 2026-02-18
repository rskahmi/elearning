<?php

namespace App\Models;

use App\Traits\UuidTraits;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialsModel extends Model
{
    use HasFactory, UuidTraits;
    protected $table = 'materials';
    protected $fillable = [
        'title',
        'file_path',
        'course_id'
    ];
}
