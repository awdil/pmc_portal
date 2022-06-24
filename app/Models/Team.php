<?php

namespace App\Models;

use Laratrust\Models\LaratrustTeam;
use Illuminate\Database\Eloquent\SoftDeletes;

class Team extends LaratrustTeam
{
	use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'display_name', 'description',
    ];
}
