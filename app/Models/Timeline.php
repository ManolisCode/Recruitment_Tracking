<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timeline extends Model
{
    use HasFactory;
    protected $fillable = [
        'recruiter_id',
        'candidate_id'
    ];

    protected $hidden = ['recruiter_id', 'candidate_id', 'updated_at'];
}
