<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Nova\Actions\Actionable;

class BlacklistIp extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'ip_address',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];
}
