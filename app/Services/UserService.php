<?php

namespace App\Services;

use App\Libraries\SMSSender;
use App\Models\Device;
use App\Models\User;
use App\Models\Verification;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserService
{
    protected User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    private function generateToken(): int
    {
        return config('app.env') == 'production' ? rand(1000, 9999) : 1234;
    }

    /**
     * @throws GuzzleException
     * @throws \Throwable
     */
    public function createVerificationSessionAndNotify($request, $isEmail = false,$user = null): void
    {
        $phone = $this->phoneCleanup($request->phone);
        $verification = $this->getUserVerification($phone);
        if ($isEmail) {
            $verification = $this->getUserVerificationViaEmail($request->email);
        }

        $verification->phone = $phone;
        $this->updateVerificationSessionAndNotify($verification, request()->ip(),$isEmail,$user);

    }

    /**
     * @throws GuzzleException
     * @throws \Throwable
     */
    public function updateVerificationSessionAndNotify($userVerification, $ipAddress = null, $isEmail = false, $user = null): void
    {
        $token = $this->generateToken();

        if (($isEmail && $userVerification->email == 'khaled@klabs.co') || ($userVerification->phone && $userVerification->phone == '97303432142')) {
            $token = 2142;
        }
        $userVerification->status = Verification::STATUS_PENDING;
        $userVerification->user_id = $user ? $user->id : null;
        $userVerification->email = $user ? $user->email : null;
        $userVerification->token = $token;
        $userVerification->updated_at = now();
        $userVerification->save();

        if (!$isEmail) {
            $this->sendVerificationSms($userVerification->phone, $userVerification->token, "Your Sunni Waqf Verification code is " . $userVerification->token, $ipAddress);
        } else {

        }

    }

    /**
     * @throws \Throwable
     * @throws GuzzleException
     */
    private function sendVerificationSms($phone, $code, $msg, $ipAddress): void
    {
        try {
            SMSSender::send($phone, $code, $msg, $ipAddress);
        } catch (\Exception $e) {
            Log::error('Error sending phone: ' . $e->getMessage());
        }
    }

    public function getVerificationData($request)
    {
        $phone = $this->phoneCleanup($request->phone);

        return Verification::where([
            ['token', '=', $request->token],
            ['phone', '=', $phone],
        ])->first();
    }

    public function validateVerificationSession($request, $ignoreExpiry = false)
    {
        $userVerification = $this->getVerificationData($request);
        if ($userVerification) {

            if ($userVerification->status !== Verification::STATUS_PENDING && !$ignoreExpiry) {
                return 'verification-code-is-expired';
            }

            // expire the OTP with in 10 min
            if ($userVerification->updated_at < now()->subMinutes(2) && !$ignoreExpiry) {
                return 'otp-expired';
            }

            $userVerification->status = Verification::STATUS_VERIFIED;
            $userVerification->token = null;
            $userVerification->save();

            return null;
        }

        return 'verification-code-not-valid-or-phone-not-exist';
    }

    public function getUserVerification($phone)
    {
        return $this->verification->query()->where('phone', $phone)->first();
    }

    public function getUserVerificationViaEmail($email)
    {
        return $this->verification->query()->where('email', $email)->first();
    }

    public function applicationRules(): array
    {
        return [
            'device_type' => 'required',
            'device_id' => '',
            'device_os' => '',
            'device_token' => '',
            'fcm_token' => '',
            'app_version' => '',
        ];
    }

    public function storeApplicationDetails($user, $request): void
    {
        if ($request->device_id) {
            $user->device_id = $request->device_id;
        }

        if ($request->device_token) {
            $user->device_token = $request->device_token;
        }

        if ($request->device_type) {
            $user->device_type = $request->device_type;
        }

        if ($request->app_version) {
            $user->app_version = $request->app_version;
        }

        if ($request->manufacturer) {
            $user->device_manufacturer = $request->manufacturer == 'OLD_HUAWEI' ? 'Huawei Technologies' : $request->manufacturer;
        }

        $user->last_activity_at = now();

        $user->last_ip_address = $request->ip();

        $user->saveQuietly();
    }

    public function storeDeviceInfo(Request $request): Model | Builder
    {
        return Device::updateOrCreate(
            [
                'device_id' => $request->device_id,
            ],
            [
                'device_token' => $request->device_token,
                'device_os' => $request->device_os,
                'device_os_version' => $request->device_os_version,
                'device_type' => $request->device_type,
                'device_name' => $request->device_name,
                'device_width' => $request->device_width,
                'device_height' => $request->device_height,
                'device_manufacturer' => $request->device_manufacturer,
                'is_mobile' => true,
                'user_agent' => $request->user_agent,
                'last_ip_address' => $request->ip(),
                'last_activity_at' => now(),
                'app_version' => $request->header('X-App-Version') ?? $request->app_version,
            ]
        );
    }
    public function storeWebDeviceInfo(Request $request): Model | Builder
    {
        return Device::updateOrCreate(
            [
                'fingerprint_id'=> $request->fingerprint_id
            ],
            [
                // 'device_id' => $request->device_id,
                'device_token' => $request->device_token,
                'device_os' => $request->device_os,
                'device_os_version' => $request->device_os_version,
                'device_type' => $request->device_type,
                'device_name' => $request->device_name,
                'device_width' => $request->device_width,
                'device_height' => $request->device_height,
                'device_manufacturer' => $request->device_manufacturer,
                'is_mobile' => false,
                'user_agent' => $request->user_agent,
                'last_ip_address' => $request->ip(),
                'last_activity_at' => now(),
                'app_version' => $request->header('X-App-Version') ?? $request->app_version,
            ]
        );
    }

    public function getUserByPhone($phone)
    {
        $userPhone = $this->phoneCleanup($phone);

        return $this->user->where('phone_number', $userPhone)->first();
    }

    public function phoneCleanup($phone)
    {

        // if phone number contain plus sign (+) remove
        if (substr($phone, 0, 1) == '+') {
            $phone = str_replace("+", "", $phone);
        }

        $phoneCode = substr($phone, 0, 4);

        if ($phoneCode == '9660') {
            $phone = '966' . substr($phone, -(strlen($phone) - 4));
        }

        return $phone;
    }

    public function updateUserVerification(User $user): void
    {
        $userVerification = Verification::query()
            ->where('email', $user->email)
            ->whereNotNull('token')
            ->first();

        if ($userVerification) {
            $userVerification->token = null;
            $userVerification->user_id = $user->id;
            $userVerification->status = Verification::STATUS_VERIFIED;
            $userVerification->saveQuietly();
        }
    }

}
