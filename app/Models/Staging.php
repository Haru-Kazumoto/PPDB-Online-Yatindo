<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Staging extends Model
{
    protected $table = 'staging';

    protected $fillable = [
        'staging_name',
        'index',
        'grade',
        'registration_type',
    ];

    public function registrationBatch(): BelongsTo
    {
        return $this->belongsTo(RegistrationBatch::class, 'batch_id');
    }
}
