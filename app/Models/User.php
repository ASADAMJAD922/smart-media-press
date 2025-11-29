<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */

    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    const SUPER_ADMINISTRATOR = 'SUPER_ADMINISTRATOR';
    const USER = 'USER';

    const PENDING = 'PENDING';
    const ACTIVE = 'ACTIVE';
    const DISABLED = 'DISABLED';

    const MALE = 'MALE';
    const FEMALE = 'FEMALE';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'device_token',
        'date_of_birth'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'date_of_birth' => 'date:Y-m-d',
        ];
    }

    public static function GET_USERS_STATUS(): array
    {
        return [
            static::PENDING => ucwords(strtolower(str_replace('_', ' ', static::PENDING))),
            static::ACTIVE => ucwords(strtolower(str_replace('_', ' ', static::ACTIVE))),
            static::DISABLED => ucwords(strtolower(str_replace('_', ' ', static::DISABLED))),
        ];
    }

    public function isSuperAdminRole(): bool
    {
        return $this->role === self::SUPER_ADMINISTRATOR;
    }

    public function isUserRole(): bool
    {
        return $this->role === self::USER;
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function devices(): BelongsToMany
    {
        return $this->belongsToMany(Device::class, DeviceUser::class, 'user_id', 'device_id')->withTimestamps();
    }

    public function createApiToken(): void
    {
        $this->token = $this->createToken('athlite')->plainTextToken;
    }

    public function isHuaweiDevice()
    {
        return $this->device_manufacturer == "HUAWEI";
    }
}
