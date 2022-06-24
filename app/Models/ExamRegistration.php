<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'exam_center_id',
        'city_id',
        'exam_calendar_timeslot_id',
        'status',
        'deleted_at',
        'challan_number',
        'reg_number',
        'is_paid',
        'paid_date',
        'challan_picture',
        'payment_method',
    ];

    protected $casts = [
        'created_at' => 'date:d/m/Y H:i:s',
    ];

    protected $appends = [
        'registration_status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function exam_center()
    {
        return $this->belongsTo(ExamCenter::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function timeslot()
    {
        return $this->belongsTo(ExamCalendarTimeslot::class, 'exam_calendar_timeslot_id', 'id');
    }

    public function getRegistrationStatusAttribute() {

        $registration = ExamRegistration::where([
            'status' => 'active', 
            'id' => $this->id,
        ])->with([
            'user',
            'exam_center',
            'city',
            'timeslot.exam_calander.exam',
        ])->first();

        if($registration && $registration->is_paid == 'Y'){
            return 'Fee Paid';
        }

        return 'Payment Pending';
    }

    public function getRegsitrationNo() {

        $registration = ExamRegistration::where([
            'status' => 'active', 
            'id' => $this->id,
        ])->with([
            'user',
            'timeslot.exam_calander.exam',
        ])->first();

        $reg_no = str_pad($registration->id, 8, '0', STR_PAD_LEFT);
        return $registration->timeslot->exam_calander->exam->id.$reg_no;
    }

    public static function getExamSeatNo() {

        $seat_no = ExamRegistration::where([
            'status' => 'active', 
        ])->max('seat_no');

        return $seat_no + 1;
    }

    public function institute()
    {
        return $this->belongsTo(Institution::class);
    }
}
