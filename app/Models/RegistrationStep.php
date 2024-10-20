<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegistrationStep extends Model
{
    protected $table = "registration_step";

    protected $fillable = [
        'title',
        'description',
        'grade'
    ];
}
