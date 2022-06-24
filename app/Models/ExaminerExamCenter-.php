<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExaminerExamCenter extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'exam_center_id',
        'status',
    ];

    public function user()
    {
        return $this->hasMany(User::class, 'id', 'user_id');
    }

    public function exam_center()
    {
        return $this->belongsToMany(ExamCenter::class, 'id','exam_center_id');
    }

}
