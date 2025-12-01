<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
        $validate = Validator::make(
            $request->all(),
            [
                'name' => 'required|string',
                'email' => 'required|email|unique:users,email,NULL,id,deleted_at,NULL',
                'password' => 'required|confirmed|min:8',
                'country_id' => 'nullable|numeric',
                'phone' => 'nullable',
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

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone,
            'country_id' => $request->country_id,
            'password' => Hash::make($request->password),
            'email_verified_at' => now(),
            'role' => User::USER,
        ]);

        return $this->formatResponse('success', 'registration-successful', $user, 200);
    }


    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validate->fails()) {
            return $this->formatResponse(
                'error',
                $validate->errors()->first(),
                'validation-error',
                400
            );
        }

        // Email exists?
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return $this->formatResponse('error', 'email-not-found', null, 404);
        }

        // Check password
        if (!Hash::check($request->password, $user->password)) {
            return $this->formatResponse('error', 'invalid-password', null, 400);
        }

        // Create token
        $token = $user->createToken('api-token')->plainTextToken;

        return $this->formatResponse(
            'success',
            'login-successful',
            [
                'user' => $user,
                'token' => $token
            ]
        );
    }

    // Get user
    public function user(Request $request)
    {
        $user = $request->user();

        return $this->formatResponse(
            'success',
            'user-details',
            $user
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

        $validate = Validator::make($request->all(), [
            'name'          => 'required|string',
            'email'         => "required|email|unique:users,email,$user->id,id,deleted_at,NULL",
            'phone'         => 'required',
            'country_id'    => 'nullable|numeric',
            'gender'        => 'nullable',
            'date_of_birth' => 'nullable|date',
            'address'       => 'nullable|string|max:255',
        ]);

        if ($validate->fails()) {
            return $this->formatResponse(
                'error',
                $validate->errors()->first(),
                'validation-error',
                400
            );
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->country_id = $request->country_id;
        $user->gender = $request->gender;
        $user->date_of_birth = $request->date_of_birth;
        $user->address = $request->address;
        $user->save();

        return $this->formatResponse('success', 'user-updated-successfully', $user);
    }

    public function deleteAccount(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return $this->formatResponse('error', 'user-not-found', null, 404);
        }

        // logout current token
        $request->user()->currentAccessToken()->delete();

        $user->delete();

        return $this->formatResponse('success', 'account-delete-successfully');
    }

    /**
     * Logout api
     *
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return $this->formatResponse('success', 'logout-successfully');
    }
}
