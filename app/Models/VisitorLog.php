<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitorLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'ip_address',
        'path',
        'page_name',
        'method',
        'referer',
        'traffic_source',
        'user_agent',
        'device_type',
        'platform',
        'browser',
        'city',
        'country',
        'session_id',
        'visited_at'
    ];

    protected $casts = [
        'visited_at' => 'datetime',
    ];
}
