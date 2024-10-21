<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Student extends Model
{
    protected $table = "student";

    protected $fillable = [
        'fullname',
        'surname',
        'phone',
        'nisn',
        'gender',
        'religion',
        'birth_place',
        'birth_date',
        'grade',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function studentAddress(): HasOne
    {
        return $this->hasOne(StudentAddress::class);
    }

    public function studentInfo(): HasOne
    {
        return $this->hasOne(StudentInfo::class);
    }

    public function studentLogs(): HasOne
    {
        return $this->hasOne(StudentLogs::class);
    }

    public function studentPayments(): HasMany
    {
        return $this->hasMany(StudentPayments::class);
    }
}
