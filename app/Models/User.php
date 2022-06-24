<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laratrust\Traits\LaratrustUserTrait;
use Illuminate\Support\Carbon;

// class User extends Authenticatable
class User extends Authenticatable implements MustVerifyEmail

{
    use LaratrustUserTrait;
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'urdu_name',
        'gender',
        'father_name',
        'email',
        'mobile_number',
        'cnic_number',
        'cnic_expire_date',
        'password',
        'status',
        'profile_picture',
        'cnic_front_img',
        'cnic_back_img',
        'mobile_verified_at',
        'mobile_verification_code',
        'nadra_verified_at',
        'country_id',
        'state_id',
        'city_id',
        'deleted_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */

    // protected $dates = [
    //     'cnic_expire_date'
    // ];

    protected $casts = [
        'email_verified_at'     => 'datetime',
        'created_at'            => 'date:d/m/Y',
        'updated_at'            => 'date:d/m/Y',
        'cnic_expire_date'      => 'date:d/m/Y',
    ];

    protected $appends = [
        'profile_picture_url', 
        'cnic_front_picture_url',
        'cnic_back_picture_url', 
        'profile_checks',
        'cnic_expire_date'
    ];

    public function getProfilePictureUrlAttribute() {
        $image = asset('uploads/avatar.png');

        if (!empty($this->profile_picture) && file_exists('uploads/candidates_images/' . $this->profile_picture)) {
            $image = asset('uploads/candidates_images/' . $this->profile_picture);
        } 

        return $image;
    }

    public function getCnicFrontPictureUrlAttribute() {
        $image = asset('uploads/picture-not-available.jpg');

        if (!empty($this->cnic_front_img) && file_exists('uploads/candidates_images/' . $this->cnic_front_img)) {
            $image = asset('uploads/candidates_images/' . $this->cnic_front_img);
        } 

        return $image;
    }

    public function getCnicBackPictureUrlAttribute() {
        $image = asset('uploads/picture-not-available.jpg');

        if (!empty($this->cnic_back_img) && file_exists('uploads/candidates_images/' . $this->cnic_back_img)) {
            $image = asset('uploads/candidates_images/' . $this->cnic_back_img);
        } 

        return $image;
    }

    function sendSmsShortcode($message, $mobile_number = null, $debug=false){

        $type = "xml";
        $id = "cd1094beacon";
        $pass = "system231";
        $lang = "English";
        $mask = "1";

        if($mobile_number == null){
            $mobile_number = $this->mobile_number;
        }

        $to = '92' . substr($mobile_number, -10);
        $message = urlencode($message);
        $data = "id=".$id."&pass=".$pass."&msg=".$message."&to=".$to."&lang=".$lang."&mask=".$mask."&type=".$type;

        $ch = curl_init('http://www.opencodes.pk/api/medver.php/sendsms/url');
        curl_setopt($ch, CURLOPT_POST, true); curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        $xml = simplexml_load_string($result);
        $api_response = $xml->code;
        curl_close($ch);
        return $api_response;
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function examiner_exam_centers()
    {
        return $this->belongsToMany(ExamCenter::class, 'examiner_exam_centers', 'user_id', 'exam_center_id');
    }
    

    public function exam_center()
    {
        return $this->belongsTo(ExamCenter::class);
    }

    public function getUserRoleNameAttribute(){
        // $user = \Auth::user();
        // $user = User::where(['id' => $user->id])->with(['roles'])->first();
        // return $user->display_name;
    }

    public function getProfileChecksAttribute(){

        $checks = [];
        if($this->nadra_verified_at == NULL){
            $checks[] = 'Your NADRA record is not verified yet';
        }
        if($this->mobile_verified_at == NULL){
            $checks[] = 'Your mobile number is not verified yet';
        }

        return $checks;
    }
    // Mutator for cnic_expire_date
    public function setCnicExpireDateAttribute($value)
    {
        $this->attributes['cnic_expire_date'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }
    // Accessor for cnic_expire_date
    public function getCnicExpireDateAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }
}
