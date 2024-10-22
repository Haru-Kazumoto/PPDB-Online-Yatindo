<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentLogs extends Model
{
    protected $fillable = [
        'status',
        'major_estimation',
        'major_fix',
        'remark',
        'registration_type',
        'batch_id',
        'staging_id',
        'student_id',
    ];

    public function registrationBatch(): BelongsTo
    {
        return $this->belongsTo(RegistrationBatch::class, 'batch_id');
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
