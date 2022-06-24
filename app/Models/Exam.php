<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'exam_title',
        'exam_description',
        'exam_start_date',
        'exam_end_date',
        'exam_fee',
        'exam_reg_start_date',
        'exam_reg_end_date',
        'status',
        'deleted_at',
    ];

    protected $casts = [
        'exam_start_date'       => 'date:d/m/Y',
        'exam_end_date'         => 'date:d/m/Y',
        'exam_reg_start_date'   => 'date:d/m/Y',
        'exam_reg_end_date'     => 'date:d/m/Y',
        'created_at'            => 'date:d/m/Y',
    ];

    protected $appends = [
        'exam_start_date', 
        'exam_end_date',
        'exam_reg_start_date', 
        'exam_reg_end_date'
    ];

    public function listActiveExams(){
        
        $exams = Exam::where(['status' => 'active'])->get()
        ->filter(function($e) {
            if (Carbon::now()->between($e->exam_start_date, $e->exam_end_date)) {
              return $e;
            }
        });

        return $exams;
    }

    // Mutator for exam_start_date
    public function setExamStartDateAttribute($value)
    {
        $this->attributes['exam_start_date'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }
    // Mutator for exam_end_date
    public function setExamEndDateAttribute($value)
    {
        $this->attributes['exam_end_date'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }
    // Mutator for exam_reg_start_date
    public function setExamRegStartDateAttribute($value)
    {
        $this->attributes['exam_reg_start_date'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }
    // Mutator for exam_reg_end_date
    public function setExamRegEndDateAttribute($value)
    {
        $this->attributes['exam_reg_end_date'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }

    // Accessors
    public function getExamStartDateAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }
    public function getExamEndDateAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }
    public function getExamRegStartDateAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }
    public function getExamRegEndDateAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }
  
}
