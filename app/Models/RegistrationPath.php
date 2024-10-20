<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RegistrationPath extends Model
{
    protected $table = 'registration_paths';

    protected $fillable = [
        'name',
        'type',
        'start_date',
        'end_date',
        'registration_price',
        'grade',
    ];

    public function registrationBatches(): HasMany
    {
        return $this->hasMany(RegistrationBatch::class);
    }
}
