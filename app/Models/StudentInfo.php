<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentInfo extends Model
{

    protected $table = "student_info";
    
    protected $fillable = [
        'school_origin',
        'profile_picture',
        'status',
        'student_id',
        'batch_id',
        'current_step',
        'step_name',
        'step_type',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
