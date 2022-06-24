<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeskService extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'to_email',
        'email_subject',
        'email_body',
        'status',
        'deleted_at',
    ];
}
