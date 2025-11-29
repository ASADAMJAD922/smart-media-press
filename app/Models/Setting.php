<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Nova\Actions\Actionable;

class Setting extends Model
{
    use HasFactory,SoftDeletes;

    const PRIVACY_POLICY = 'PRIVACY_POLICY';
    const TERMS_AND_CONDITIONS = 'TERMS_AND_CONDITIONS';
    const ABOUT_US = 'ABOUT_US';
    const IOS_APP_VERSION = 'IOS_APP_VERSION';
    const IOS_FORCE_UPDATE = 'IOS_FORCE_UPDATE';
    const IOS_STORE_LINK = 'IOS_STORE_LINK';
    const ANDROID_STORE_LINK = 'ANDROID_STORE_LINK';
    const ANDROID_APP_VERSION = 'ANDROID_APP_VERSION';
    const ANDROID_FORCE_UPDATE = 'ANDROID_FORCE_UPDATE';
    const HUAWEI_STORE_LINK = 'HUAWEI_STORE_LINK';
    const HUAWEI_APP_VERSION = 'HUAWEI_APP_VERSION';
    const HUAWEI_FORCE_UPDATE = 'HUAWEI_FORCE_UPDATE';
    const LIMIT_FOR_SHOW_APP_REVIEW_DIALOG = 'LIMIT_FOR_SHOW_APP_REVIEW_DIALOG';
    const ANDROID_APP_REVIEW_URL = 'ANDROID_APP_REVIEW_URL';
    const IOS_APP_REVIEW_URL = 'IOS_APP_REVIEW_URL';
    const CONTACT_METHOD = 'CONTACT_METHOD';
    const CREDIT_VALUE = 'CREDIT_VALUE';
    const CREDIT_GRACE_PERIOD = 'CREDIT_GRACE_PERIOD';
    const RENEW_GRACE_PERIOD = 'RENEW_GRACE_PERIOD';
    const WEEKEND_DAYS = 'WEEKEND_DAYS';

    const APP_ENV = 'APP_ENV';
    const WHATSAPP = 'WHATSAPP';
    const INSTAGRAM = 'INSTAGRAM';
    const FACEBOOK = 'FACEBOOK';
    const WEBSITE = 'WEBSITE';
    const TWITTER = 'TWITTER';
    const VAT = 'VAT';
    const IS_DEBUG = 'IS_DEBUG';

    const TEXT = 'TEXT';
    const LONG_TEXT = 'LONG_TEXT';

    const PERCENTAGE = 'PERCENTAGE';
    const FLAT = 'FLAT';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'value',
        'type',
        'show_in_app',
        'show_in_web',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'show_in_app' => 'boolean',
        'show_in_web' => 'boolean',
    ];

    public static function GET_SETTING_TYPE(): array
    {
        return [
            static::TEXT => ucwords(strtolower(str_replace('_', ' ', static::TEXT))),
            static::LONG_TEXT => ucwords(strtolower(str_replace('_', ' ', static::LONG_TEXT))),

        ];
    }

    public static function GET_TAX_TYPE()
    {
        return [
            static::PERCENTAGE => ucwords(strtolower(str_replace('_', ' ', static::PERCENTAGE))),
            static::FLAT => ucwords(strtolower(str_replace('_', ' ', static::FLAT))),
        ];
    }

    public function scopeIsShowInApp($query)
    {
        return $query->where('show_in_app', true);
    }

    public function scopeIsShowInWeb($query)
    {
        return $query->where('show_in_web', true);
    }
}
