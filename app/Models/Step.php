<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    use HasFactory;
    protected $fillable = [
        'candidate_id',
        'timeline_id',
        'step_category_id',
        'status_category_id',
        'recruiter_id'
    ];
}
