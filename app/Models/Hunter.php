<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hunter extends Model
{
    protected $fillable = [
        'name',
        'rank',
        'class',
        'level',
        'power',
    ];
}
