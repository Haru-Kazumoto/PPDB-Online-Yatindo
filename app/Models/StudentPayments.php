<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentPayments extends Model
{
    protected $fillable = [
        'total',
        'payment_method',
        'payment_image',
        'status',
        'student_id',
        'batch_id',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function registrationBatch(): BelongsTo
    {
        return $this->belongsTo(RegistrationBatch::class, 'batch_id');
    }
}
