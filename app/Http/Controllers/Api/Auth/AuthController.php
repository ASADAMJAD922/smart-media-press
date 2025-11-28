<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\InitializeRequest;
use App\Models\BlacklistIp;
use App\Models\Cart;
use App\Models\Country;
use App\Models\Device;
use App\Models\Otp;
use App\Models\SmsLog;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $phone_code_length = 0;
        $phoneMaxlength = 0;
        $cprMaxLength = 0;
        if (isset($request->phone) && $request->phone && $request->country_id) {
            if (str_starts_with($request->phone, '+')) {
                $phone_code_length = strlen(Country::query()->find($request->country_id)->phone_code) + Country::query()->find($request->country_id)->phone_digits;
                $phoneMaxlength = Country::query()->find($request->country_id)->phone_digits;
            } else {
                $phone_code_length = strlen($this->userService->phoneCleanup(Country::query()->find($request->country_id)->phone_code)) + Country::query()->find($request->country_id)->phone_digits;
                $phoneMaxlength = Country::query()->find($request->country_id)->phone_digits;
            }
        }
        
        if (isset($request->cpr_number) && $request->cpr_number && $request->country_id) {
            $cprMaxLength = Country::query()->find($request->nationality_id)->cpr_number_digits;
        }

        $validate = Validator::make(
            $request->all(),
            [
                'name' => 'required|string',
                'country_id' => 'required|numeric',
                'nationality_id' => 'required|numeric',
                'phone' => "required|max:$phone_code_length",
                'cpr_number' => "required|string|unique:users,cpr_number,NULL,id,deleted_at,NULL|min:$cprMaxLength|max:$cprMaxLength",
                'email' => 'nullable|email|unique:users,email,NULL,id,deleted_at,NULL',
            ],
            [
                'phone.required' => __('validation.required', ['attribute' => __('validation.attributes.phone')]),
                'phone.min' => __('validation.min', ['attribute' => __('validation.attributes.phone'), 'min' => $phoneMaxlength]),
                'phone.max' => __('validation.max', ['attribute' => __('validation.attributes.phone'), 'max' => $phoneMaxlength]),
                'cpr_number.required' => __('validation.required', ['attribute' => __('validation.attributes.cpr_number')]),
                'cpr_number.unique' => __('validation.unique', ['attribute' => __('validation.attributes.cpr_number')]),
                'cpr_number.min' => __('validation.min', ['attribute' => __('validation.attributes.cpr_number'), 'min' => $cprMaxLength]),
                'cpr_number.max' => __('validation.max', ['attribute' => __('validation.attributes.cpr_number'), 'max' => $cprMaxLength]),
                'email.unique' => __('validation.unique', ['attribute' => __('validation.attributes.email')]),
                'email.email' => __('validation.email', ['attribute' => __('validation.attributes.email')]),
                'country_id.required' => __('validation.required', ['attribute' => __('validation.attributes.country_id')]),
                'country_id.numeric' => __('validation.numeric', ['attribute' => __('validation.attributes.country_id')]),
                'nationality_id.required' => __('validation.required', ['attribute' => __('validation.attributes.nationality_id')]),
                'nationality_id.numeric' => __('validation.numeric', ['attribute' => __('validation.attributes.nationality_id')]),
            ]
        );

        if ($validate->fails()) {
            return $this->formatResponse(
                'error',
                $validate->errors()->first(),
                'validation-error',
                400
            );
        }

        $phone = $this->userService->phoneCleanup($request->phone);

        $userPhone = User::query()
            ->whereNotNull('phone_number')->where('phone_number', $phone)
            ->first();

        if ($userPhone) {
            return $this->formatResponse('error', 'this-phone-number-is-already-in-use', null, 400);
        }

        $userSmsLogWithSameIP = SmsLog::query()
            ->where('phone', $phone)
            ->where('ip_address', $request->ip())
            ->where('created_at', '>=', now()->subHour())
            ->where('created_at', '<=', now())
            ->successSms()
            ->count();

        if ($userSmsLogWithSameIP >= 15 && (config('app.env') !== 'local' && config('app.env') !== 'staging')) {

            return $this->formatResponse('error', 'your-per-hour-limit-is-reached', null, 400);
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone_number = $phone;
        $user->country_id = $request->country_id;
        $user->nationality_id = $request->nationality_id;
        $user->cpr_number = $request->cpr_number;
        $user->email_verified_at = now();
        $user->role = User::USER;
        $user->save();

        $this->userService->createVerificationSessionAndNotify($request, false, $user);

        return $this->formatResponse(
            'success',
            'code-has-been-sent'
        );
    }

    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $phone_code_length = 0;
        $phoneMaxlength = 0;
        if (isset($request->phone) && $request->phone && $request->country_id) {
            if (str_starts_with($request->phone, '+')) {
                $phone_code_length = strlen(Country::query()->find($request->country_id)->phone_code) + Country::query()->find($request->country_id)->phone_digits;
                $phoneMaxlength = Country::query()->find($request->country_id)->phone_digits;
            } else {
                $phone_code_length = strlen($this->userService->phoneCleanup(Country::query()->find($request->country_id)->phone_code)) + Country::query()->find($request->country_id)->phone_digits;
                $phoneMaxlength = Country::query()->find($request->country_id)->phone_digits;
            }
        }

        $validate = Validator::make(
            $request->all(),
            [
                'country_id' => 'required|numeric',
                'phone' => 'required|max:' . $phone_code_length,
            ],
            [
                'phone.required' => __('validation.required', ['attribute' => __('validation.attributes.phone')]),
                'phone.max' => __('validation.max', ['attribute' => __('validation.attributes.phone'), 'max' => $phoneMaxlength]),
                'country_id.required' => __('validation.required', ['attribute' => __('validation.attributes.country_id')]),
                'country_id.numeric' => __('validation.numeric', ['attribute' => __('validation.attributes.country_id')]),
            ]
        );

        if ($validate->fails()) {
            return $this->formatResponse(
                'error',
                $validate->errors()->first(),
                'validation-error',
                400
            );
        }

        $phone = $this->userService->phoneCleanup($request->phone);

        $user = $this->userService->getUserByPhone($phone);

        if (!$user) {
            return $this->formatResponse(
                'error',
                'user-signup-required',
                null,
                400
            );
        }

        if ($phone == '97303432142') {

            return $this->formatResponse('success', 'code-has-been-sent');
        }

        $isInBlackList = BlacklistIp::query()->where('ip_address', $request->ip())->first();

        if ($isInBlackList && (config('app.env') !== 'local' && config('app.env') !== 'staging')) {

            return $this->formatResponse('error', 'this-ip-address-is-blocked', null, 400);
        }

        $userSmsLogWithSameIP = SmsLog::query()
            ->where('phone', $phone)
            ->where('ip_address', $request->ip())
            ->where('created_at', '>=', now()->subHour())
            ->where('created_at', '<=', now())
            ->successSms()
            ->count();

        if ($userSmsLogWithSameIP >= 15 && (config('app.env') !== 'local' && config('app.env') !== 'staging')) {
            return $this->formatResponse('error', 'your-per-hour-limit-is-reached', null, 400);
        }

        $userVerification = $this->userService->getUserVerification($request->phone);
        if ($userVerification) {
            $this->userService->updateVerificationSessionAndNotify($userVerification, $request->ip(), false, $user);
        } else {
            $this->userService->createVerificationSessionAndNotify($request, false, $user);
        }

        return $this->formatResponse(
            'success',
            'code-has-been-sent'
        );
    }

    /**
     * Verify Otp api
     *
     * @return \Illuminate\Http\Response
     */
    public function verifyOtp(Request $request)
    {

        $phone_code_length = 0;
        $phoneMaxlength = 0;
        if (isset($request->phone) && $request->phone && $request->country_id) {

            if (str_starts_with($request->phone, '+')) {
                $phone_code_length = strlen(Country::query()->find($request->country_id)->phone_code) + Country::query()->find($request->country_id)->phone_digits;
                $phoneMaxlength = Country::query()->find($request->country_id)->phone_digits;
            } else {
                $phone_code_length = strlen($this->userService->phoneCleanup(Country::query()->find($request->country_id)->phone_code)) + Country::query()->find($request->country_id)->phone_digits;
                $phoneMaxlength = Country::query()->find($request->country_id)->phone_digits;
            }
        }

        $validate = Validator::make(
            $request->all(),
            [
                'country_id' => 'required|numeric',
                'phone' => 'required|max:' . $phone_code_length,
                'token' => 'required|numeric|min_digits:4|max_digits:4',
            ],
            [
                'phone.unique' => 'This phone number is already in use',
                'phone.required' => 'The phone number field is required',
                'phone.max' => 'The phone number must be exactly ' . $phoneMaxlength . ' digits long',
            ]
        );

        if ($validate->fails()) {
            return $this->formatResponse(
                'error',
                $validate->errors()->first(),
                'validation-error',
                400
            );
        }

        $phone = $this->userService->phoneCleanup($request->phone);

        $user = $this->userService->getUserByPhone($phone);

        if (!$user) {
            return $this->formatResponse(
                'error',
                'user-signup-required',
                null,
                400
            );
        }

        $otpValidation = null;

        // set up backdoor for apple to login
        if (!($phone == '97303432142' && $request->token == '2142')) {

            $otpValidation = $this->userService->validateVerificationSession($request);
        }

        $user = $this->userService->getUserByPhone($phone);
        $isNewUser = false;
        if (!$user->phone_verified_at) {
            $isNewUser = true;
            $user->phone_verified_at = now();
            $user->saveQuietly();
        }

        if ($otpValidation) {
            return $this->formatResponse(
                'error',
                $otpValidation,
                null,
                400
            );
        }

        if (!$otpValidation) {

            $this->userService->storeApplicationDetails($user, $request);

            $user->createApiToken();
            $user->loadMissing(['country', 'nationality']);
            $user->is_new_user = $isNewUser;
            $this->phoneRemoveCode($user);

            $device = $request->device;
            Cart::where('status', Cart::STATUS_PENDING)->where('device_id', $device->id)->update([
                'user_id' => $user->id
            ]);

            return $this->formatResponse('success', 'login-successfully', $user)->withHeaders([
                'x-auth-token' => $user->token,
            ]);
        }
    }

    /**
     * @throws Throwable
     * @throws GuzzleException
     */
    public function resendCode(Request $request)
    {
        $phone_code_length = 0;

        $phoneMaxlength = 0;
        if (isset($request->phone) && $request->phone && $request->country_id) {

            if (str_starts_with($request->phone, '+')) {
                $phone_code_length = strlen(Country::query()->find($request->country_id)->phone_code) + Country::query()->find($request->country_id)->phone_digits;
                $phoneMaxlength = Country::query()->find($request->country_id)->phone_digits;
            } else {
                $phone_code_length = strlen($this->userService->phoneCleanup(Country::query()->find($request->country_id)->phone_code)) + Country::query()->find($request->country_id)->phone_digits;
                $phoneMaxlength = Country::query()->find($request->country_id)->phone_digits;
            }
        }

        $validate = Validator::make(
            $request->all(),
            [
                'country_id' => 'required|numeric',
                'phone' => 'required|max:' . $phone_code_length,
            ],
            [
                'phone.unique' => 'This phone number is already in use',
                'phone.required' => 'The phone number field is required',
                'phone.max' => 'The phone number must be exactly ' . $phoneMaxlength . ' digits long',
            ]
        );

        if ($validate->fails()) {
            return $this->formatResponse(
                'error',
                $validate->errors()->first(),
                'validation-error',
                400
            );
        }

        $phone = $this->userService->phoneCleanup($request->phone);

        $user = $this->userService->getUserByPhone($phone);

        if (!$user) {
            return $this->formatResponse(
                'error',
                'user-signup-required',
                null,
                400
            );
        }

        if ($request->phone == '97303432142') {
            return $this->formatResponse('success', 'code-has-been-sent');
        }

        $userVerification = $this->userService->getUserVerification($request->phone);

        $isInBlackList = BlacklistIp::query()->where('ip_address', $request->ip())->first();

        if ($isInBlackList && (config('app.env') !== 'local' && config('app.env') !== 'staging')) {

            return $this->formatResponse('error', 'this-ip-address-is-blocked', null, 400);
        }

        $userSmsLogWithSameIP = SmsLog::query()
            ->where('phone', $phone)
            ->where('ip_address', $request->ip())
            ->where('created_at', '>=', now()->subHour())
            ->where('created_at', '<=', now())
            ->successSms()
            ->count();

        if ($userSmsLogWithSameIP >= 15 && (config('app.env') !== 'local' && config('app.env') !== 'staging')) {
            return $this->formatResponse('error', 'your-per-hour-limit-is-reached', null, 400);
        }
        if ($userVerification) {

            $this->userService->updateVerificationSessionAndNotify($userVerification, $request->ip(), false, $user);
        } else {
            $this->userService->createVerificationSessionAndNotify($request, false, $user);
        }

        return $this->formatResponse(
            'success',
            'code-has-been-sent'
        );
    }

    /**
     * Update the authenticated user's profile.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateProfile(Request $request)
    {

        $user = Auth::user();

        if (!$user) {
            return $this->formatResponse('error', 'user-not-found', null, 400);
        }

        $phone_code_length = 0;
        $phoneMaxlength = 0;
        $cprMaxLength = 0;

        if (isset($request->phone) && $request->phone && $request->country_id) {

            if (str_starts_with($request->phone, '+')) {
                $phone_code_length = strlen(Country::query()->find($request->country_id)->phone_code) + Country::query()->find($request->country_id)->phone_digits;
                $phoneMaxlength = Country::query()->find($request->country_id)->phone_digits;
            } else {
                $phone_code_length = strlen($this->userService->phoneCleanup(Country::query()->find($request->country_id)->phone_code)) + Country::query()->find($request->country_id)->phone_digits;
                $phoneMaxlength = Country::query()->find($request->country_id)->phone_digits;
            }
        }

        if (isset($request->cpr_number) && $request->cpr_number && $request->country_id) {
            $cprMaxLength = Country::query()->find($request->nationality_id)->cpr_number_digits;
        }

        $validate = Validator::make(
            $request->all(),
            [
                'name' => 'required|string',
                'country_id' => 'required|numeric',
                'nationality_id' => 'required|numeric',
                'phone' => "required|max:$phone_code_length",
                'email' => "required|unique:users,email,$user->id,id,deleted_at,NULL|email",
                'cpr_number' => "required|string|unique:users,cpr_number,$user->id,id,deleted_at,NULL|min:$cprMaxLength|max:$cprMaxLength",
            ],
            [
                'phone.required' => __('validation.required', ['attribute' => __('validation.attributes.phone')]),
                'phone.min' => __('validation.min', ['attribute' => __('validation.attributes.phone'), 'min' => $phoneMaxlength]),
                'phone.max' => __('validation.max', ['attribute' => __('validation.attributes.phone'), 'max' => $phoneMaxlength]),
                'email.unique' => __('validation.unique', ['attribute' => __('validation.attributes.email')]),
                'email.email' => __('validation.email', ['attribute' => __('validation.attributes.email')]),
                'country_id.required' => __('validation.required', ['attribute' => __('validation.attributes.country_id')]),
                'country_id.numeric' => __('validation.numeric', ['attribute' => __('validation.attributes.country_id')]),
                'nationality_id.required' => __('validation.required', ['attribute' => __('validation.attributes.nationality_id')]),
                'nationality_id.numeric' => __('validation.numeric', ['attribute' => __('validation.attributes.nationality_id')]),
                'cpr_number.required' => __('validation.required', ['attribute' => __('validation.attributes.cpr_number')]),
                'cpr_number.unique' => __('validation.unique', ['attribute' => __('validation.attributes.cpr_number')]),
                'cpr_number.min' => __('validation.min', ['attribute' => __('validation.attributes.cpr_number'), 'min' => $cprMaxLength]),
                'cpr_number.max' => __('validation.max', ['attribute' => __('validation.attributes.cpr_number'), 'max' => $cprMaxLength]),
            ]
        );
        
        if ($validate->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validate->errors()->first(), // Return the first validation error
                'errors' => $validate->errors(), // Optionally include all errors
            ], 400);
        }

        if ($validate->fails()) {
            return $this->formatResponse(
                'error',
                $validate->errors()->first(),
                'validation-error',
                400
            );
        }



        if (isset($request->name) && $request->name) {
            $user->name = $request->name;
        }

        if (isset($request->email) && $request->email) {
            $user->email = $request->email;
        }

        if (isset($request->nationality_id) && $request->nationality_id) {
            $user->nationality_id = $request->nationality_id;
        }

        if (isset($request->cpr_number) && $request->cpr_number) {
            $user->cpr_number = $request->cpr_number;
        }

        if (isset($request->country_id) && $request->country_id) {
            $user->country_id = $request->country_id;
        }
        $is_new_phone_number = false;

        if (isset($request->phone) && $request->phone) {


            $oldPhone = $this->userService->phoneCleanup($user->phone_number);
            $phone = $this->userService->phoneCleanup($request->phone);

            $userPhone = User::query()
                ->whereNotNull('phone_number')
                ->where('id', '!=', $user->id)
                ->where('phone_number', $phone)
                ->first();

            if ($userPhone) {
                return $this->formatResponse('error', 'this-phone-number-is-already-in-use', null, 400);
            }

            if ($phone != $oldPhone) {
                $is_new_phone_number = true;

                $userVerification = $this->userService->getUserVerification($phone);

                $isInBlackList = BlacklistIp::query()->where('ip_address', $request->ip())->first();

                if ($isInBlackList && (config('app.env') !== 'local' && config('app.env') !== 'staging')) {

                    return $this->formatResponse('error', 'this-ip-address-is-blocked', null, 400);
                }

                $userSmsLogWithSameIP = SmsLog::query()
                    ->where('phone', $phone)
                    ->where('ip_address', $request->ip())
                    ->where('created_at', '>=', now()->subHour())
                    ->where('created_at', '<=', now())
                    ->successSms()
                    ->count();

                if ($userSmsLogWithSameIP >= 15 && (config('app.env') !== 'local' && config('app.env') !== 'staging')) {
                    return $this->formatResponse('error', 'your-per-hour-limit-is-reached', null, 400);
                }

                if ($userVerification) {

                    $this->userService->updateVerificationSessionAndNotify($userVerification, $request->ip(), false, $user);
                } else {
                    $this->userService->createVerificationSessionAndNotify($request, false, $user);
                }
            }
        }

        $user->save();

        $user->is_request_for_update_phone_number = $is_new_phone_number;
        $this->phoneRemoveCode($user);
        return $this->formatResponse('success', 'update-user-info', $user->load(['country', 'nationality']));
    }

    /**
     * Verify Otp api
     *
     * @return \Illuminate\Http\Response
     */
    public function UpdatePhoneNumber(Request $request)
    {

        $user = Auth::user();

        if (!$user) {
            return $this->formatResponse('error', 'user-not-found', null, 400);
        }

        $phone_code_length = 0;
        $phoneMaxlength = 0;
        if (isset($request->phone) && $request->phone && $request->country_id) {

            if (str_starts_with($request->phone, '+')) {
                $phone_code_length = strlen(Country::query()->find($request->country_id)->phone_code) + Country::query()->find($request->country_id)->phone_digits;
                $phoneMaxlength = Country::query()->find($request->country_id)->phone_digits;
            } else {
                $phone_code_length = strlen($this->userService->phoneCleanup(Country::query()->find($request->country_id)->phone_code)) + Country::query()->find($request->country_id)->phone_digits;
                $phoneMaxlength = Country::query()->find($request->country_id)->phone_digits;
            }
        }

        $validate = Validator::make(
            $request->all(),
            [
                'country_id' => 'required|numeric',
                'phone' => "required|unique:users,phone_number,$user->id,id,deleted_at,NULL|max:$phone_code_length",
                'token' => 'required|numeric|min_digits:4|max_digits:4',
            ],
            [
                'phone.unique' => 'This phone number is already in use',
                'phone.required' => 'The phone number field is required',
                'phone.min' => 'The phone number must be exactly ' . $phoneMaxlength . ' digits long',
                'phone.max' => 'The phone number must be exactly ' . $phoneMaxlength . ' digits long',
            ]
        );

        if ($validate->fails()) {
            return $this->formatResponse(
                'error',
                $validate->errors()->first(),
                'validation-error',
                400
            );
        }

        $phone = $this->userService->phoneCleanup($request->phone);

        $otpValidation = null;

        // set up backdoor for apple to login
        if (!($phone == '97303432142' && $request->token == '2142')) {

            $otpValidation = $this->userService->validateVerificationSession($request);
        }

        if ($otpValidation) {
            return $this->formatResponse(
                'error',
                $otpValidation,
                null,
                400
            );
        }

        $user->phone_verified_at = now();
        $user->phone_number = $phone;
        $user->country_id = $request->country_id;
        $user->save();
        $this->phoneRemoveCode($user);
        return $this->formatResponse('success', 'phone-successfully-updated', $user->load('country'), 200);
    }

    /**
     * @throws Throwable
     * @throws GuzzleException
     */
    public function resendPhoneNumberCode(Request $request)
    {

        $user = Auth::user();

        if (!$user) {
            return $this->formatResponse('error', 'user-not-found', null, 400);
        }

        $phone_code_length = 0;

        $phoneMaxlength = 0;
        if (isset($request->phone) && $request->phone && $request->country_id) {

            if (str_starts_with($request->phone, '+')) {
                $phone_code_length = strlen(Country::query()->find($request->country_id)->phone_code) + Country::query()->find($request->country_id)->phone_digits;
                $phoneMaxlength = Country::query()->find($request->country_id)->phone_digits;
            } else {
                $phone_code_length = strlen($this->userService->phoneCleanup(Country::query()->find($request->country_id)->phone_code)) + Country::query()->find($request->country_id)->phone_digits;
                $phoneMaxlength = Country::query()->find($request->country_id)->phone_digits;
            }
        }

        $validate = Validator::make(
            $request->all(),
            [
                'country_id' => 'required|numeric',
                'phone' => 'required|min:' . $phone_code_length,
            ],
            [
                'phone.unique' => 'This phone number is already in use',
                'phone.required' => 'The phone number field is required',
                'phone.min' => 'The phone number must be exactly ' . $phoneMaxlength . ' digits long',
            ]
        );

        if ($validate->fails()) {
            return $this->formatResponse(
                'error',
                $validate->errors()->first(),
                'validation-error',
                400
            );
        }

        $phone = $this->userService->phoneCleanup($request->phone);

        if ($request->phone == '97303432142') {

            return $this->formatResponse('success', 'code-has-been-sent');
        }

        $userVerification = $this->userService->getUserVerification($request->phone);

        $isInBlackList = BlacklistIp::query()->where('ip_address', $request->ip())->first();

        if ($isInBlackList && (config('app.env') !== 'local' && config('app.env') !== 'staging')) {

            return $this->formatResponse('error', 'this-ip-address-is-blocked', null, 400);
        }

        $userSmsLogWithSameIP = SmsLog::query()
            ->where('phone', $phone)
            ->where('ip_address', $request->ip())
            ->where('created_at', '>=', now()->subHour())
            ->where('created_at', '<=', now())
            ->successSms()
            ->count();

        if ($userSmsLogWithSameIP >= 15 && (config('app.env') !== 'local' && config('app.env') !== 'staging')) {
            return $this->formatResponse('error', 'your-per-hour-limit-is-reached', null, 400);
        }
        if ($userVerification) {

            $this->userService->updateVerificationSessionAndNotify($userVerification, $request->ip(), false, $user);
        } else {
            $this->userService->createVerificationSessionAndNotify($request, false, $user);
        }

        return $this->formatResponse(
            'success',
            'code-has-been-sent'
        );
    }

    public function deleteAccount(Request $request)
    {
        //Retrieve the information of the authenticated user
        $user = Auth::user();

        $user->device_token = null;

        $user->saveQuietly();

        // Revoke the token for the current authenticated user
        $token = Auth::user()->currentAccessToken();
        $token->delete();

        if ($user->delete()) {
            return $this->formatResponse('success', 'account-delete-successfully', null, 200);
        } else {

            return $this->formatResponse('error', 'account-is-already-deleted', null, 400);
        }
    }

    /**
     * Logout api
     *
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        if ($request->user()->currentAccessToken()->delete()) {

            $request->user()->update(['device_token' => null]);

            return $this->formatResponse('success', 'logout-successfully');
        }
    }

    private function phoneRemoveCode($user)
    {
        $phonecode = str_replace("+", "", optional($user->country)->phone_code);
        $user->phone_number = str_replace($phonecode, "", $user->phone_number);
        return $user;
    }
}
