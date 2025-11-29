<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Device extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'device_id',
        'fingerprint_id',
        'device_token',
        'device_os',
        'device_os_version',
        'device_name',
        'device_width',
        'device_height',
        'is_mobile',
        'user_agent',
        'last_ip_address',
        'last_activity_at',
        'app_version',
        'timezone',
    ];

    protected $casts = [
        'last_activity_at' => 'datetime',
    ];

    public function scopeIsMobile($query){
        $query->where('is_mobile', true);
    }

    public function scopeGuest($query){
        return $query->whereNotNull('user_id');
    }
    public function scopeNativeMobile($query){
        return $query->whereNotNull('device_id');
    }
    public function scopeWebsite($query){
        return $query->whereNotNull('fingerprint_id');
    }
}
