<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamCenter extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'address',
        'longitude',
        'latitude',
        'city_id',
        'status',
        'capacity',
    ];


    public function getData()
    {
        return static::orderBy('created_at','desc')->get();
    }
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function exam_center_examiners()
    {
        return $this->belongsToMany(User::class, 'examiner_exam_centers', 'user_id', 'exam_center_id');
    }

}
