<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'academic_achievement',
        'institute',
        'roll_number',
        'total_marks',
        'obtain_marks',
        'grade',
        'passing_year',
        'document',
        'status',
    ];

    protected $appends = [
        'document_url', 
    ];

    public function getdocumentUrlAttribute() {
        $image = asset('uploads/placeholder.png');

        if (!empty($this->document) && file_exists('uploads/candidates_documents/' . $this->document)) {
            $image = asset('uploads/candidates_documents/' . $this->document);
        } 

        return $image;
    }

    public function institute()
    {
        return $this->belongsTo(Institution::class);
    }
}
