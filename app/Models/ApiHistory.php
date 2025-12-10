<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApiHistory extends Model
{
    protected $fillable = [
        'method',
        'url',
        'headers',
        'body',
        'response_status',
        'response_body',
    ];

    protected $casts = [
        'headers' => 'array',
    ];
}
