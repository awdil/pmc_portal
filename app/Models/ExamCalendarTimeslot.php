<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ExamCalendar;
use App\Models\ExamRegistration;


class ExamCalendarTimeslot extends Model
{
    use HasFactory;

    protected $fillable = [
        'exam_calender_id',
        'time_from',
        'time_to',
        'exam_begins_at',
        'exam_end_at',
        'status',
        'deleted_at',
    ];

    protected $appends = [
        'name', 'avalible_seats'
    ];

    protected $casts = [
        'created_at' => 'date:d/m/Y',
    ];

    public function getNameAttribute() {
        return $this->time_from.' - '.$this->time_to;
    }

    public function exam_calander()
    {
        return $this->belongsTo(ExamCalendar::class, 'exam_calender_id', 'id');
    }

    public function getAvalibleSeatsAttribute() {

        return $this->checkSeatAvalibality($this->id, $this->exam_calender_id);
    }

    public static function checkSeatAvalibality($exam_calendar_timeslot_id, $exam_calender_id){

        $total_reg_count = ExamRegistration::where('exam_calendar_timeslot_id', $exam_calendar_timeslot_id)->count();
        $exam_calendar = ExamCalendar::where('id', $exam_calender_id)->with(['exam_center'])->first();

        $total_capacity = $exam_calendar->exam_center->capacity;

        if($total_capacity && $total_capacity > 0){
            return $total_capacity - $total_reg_count;
        } 

        return 0;

    }
}
