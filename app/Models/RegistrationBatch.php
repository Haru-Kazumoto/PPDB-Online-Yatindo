<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class RegistrationBatch extends Model
{
    protected $table = "registration_batch";

    protected $fillable = [
        'name',
        'max_quota',
        'start_date',
        'end_date',
        'bank_name',
        'bank_username',
        'bank_number_account',
        'registration_price',
        'registration_path_id',
        'batch_code',
        'type',
        'sub_type',
    ];

    public function registrationPaths(): BelongsTo
    {
        return $this->belongsTo(RegistrationPath::class, 'registration_path_id');
    }


    public function students(): HasMany
    {
        return $this->hasMany(StudentInfo::class, 'batch_id'); // Relasi ke model StudentInfo dengan foreign key 'batch_id'
    }

    public function returnStudents(): HasMany
    {
        return $this->hasMany(StudentInfo::class, 'return_batch_id');
    }
}
