<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentAddress extends Model
{

    protected $table = 'student_address';
    protected $fillable = [
        'address',
        'province',
        'city',
        'district',
        'sub_district',
        'postal_code',
        'student_id',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
