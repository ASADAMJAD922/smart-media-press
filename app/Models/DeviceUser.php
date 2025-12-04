<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DeviceUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'device_id'
    ];

    protected $casts = [
        'user_id' => 'integer',
        'device_id' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function device(): BelongsTo
    {
        return $this->belongsTo(Device::class,'device_id');
    }
}
