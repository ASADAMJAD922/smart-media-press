<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Nova\Actions\Actionable;

class SmsLog extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'message_body',
        'phone',
        'sent',
        'ip_address',
        'blocked',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'sent' => 'boolean',
        'blocked'=> 'boolean',
    ];


    public function scopeIsBlocked($query){
        $query->where('blocked', true);
    }

    public function scopeIsUnBlocked($query){
        $query->where('blocked', false);
    }

    public function scopeSuccessSms($query){
        $query->where('sent', true);
    }

    public function scopeUnSuccessSms($query){
        $query->where('sent', false);
    }
}
