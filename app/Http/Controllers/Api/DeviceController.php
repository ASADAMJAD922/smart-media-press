<?php

namespace App\Http\Controllers\Api;

use App\Helper\General;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Device;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DeviceController extends Controller
{

    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function syncDevice(Request $request): JsonResponse
    {
        $validate = Validator::make($request->all(), [
            'device_id' => 'required',
            'device_token' => 'nullable',
            'device_os' => 'required',
            'device_os_version' => 'required',
            'device_type' => 'nullable',
            'device_name' => 'nullable',
            'device_width' => 'nullable|numeric',
            'device_height' => 'nullable|numeric',
            'user_agent' => 'nullable',
            'device_manufacturer' => 'nullable',
        ]);

        if ($validate->fails()) {
            return $this->formatResponse(
                'error',
                $validate->errors()->first(),
                'validation-error',
                400
            );
        }

        $device = $this->userService->storeDeviceInfo($request);

        if ($request->user('sanctum')) {
            $device->users()->syncWithoutDetaching($request->user('sanctum')->id);
        }

        return $this->formatResponse('success', 'device-sync-successfully', $device);
    }

    public function syncDeviceWeb(Request $request): JsonResponse
    {
        $validate = Validator::make($request->all(), [
            'fingerprint_id' => 'required',
            'device_id' => 'nullable',
            'device_token' => 'nullable',
            'device_os' => 'required',
            'device_os_version' => 'required',
            'device_type' => 'nullable',
            'device_name' => 'nullable',
            'device_width' => 'nullable|numeric',
            'device_height' => 'nullable|numeric',
            'user_agent' => 'nullable',
            'device_manufacturer' => 'nullable',
        ]);

        if ($validate->fails()) {
            return $this->formatResponse(
                'error',
                $validate->errors()->first(),
                'validation-error',
                400
            );
        }

        $device = $this->userService->storeWebDeviceInfo($request);

        if ($request->user('sanctum')) {
            $device->users()->syncWithoutDetaching($request->user('sanctum')->id);
        }

        return $this->formatResponse('success', 'device-sync-successfully', $device);
    }
}
