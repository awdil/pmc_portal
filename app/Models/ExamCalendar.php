<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class ExamCalendar extends Model
{
    use HasFactory;

    protected $fillable = [
        'exam_id',
        'exam_center_id',
        'exam_date',
        'status',
    ];

    protected $dates = [
        'exam_date'
    ];

    protected $casts = [
        'exam_date' => 'date:d/m/Y',
        'created_at' => 'date:d/m/Y',
    ];

    protected $appends = [
        'name', 
    ];

    public function getNameAttribute() {
        return $this->exam_date->format('d/m/Y');
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function exam_center()
    {
        return $this->belongsTo(ExamCenter::class);
    }

    public function timeslots()
    {
        return $this->hasMany(ExamCalendarTimeslot::class, 'exam_calender_id', 'id');
    }

    //Mutator for exam date
    public function setExamDateAttribute($value)
    {
        $this->attributes['exam_date'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }

}
