<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lookup extends Model
{
    protected $fillable = [
        'label',
        'value',
        'category'
    ];
}
