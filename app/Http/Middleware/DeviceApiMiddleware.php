<?php

namespace App\Http\Middleware;

use App\Models\Device;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class DeviceApiMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->header('Accept-Language')) {
            App::setLocale($request->header('Accept-Language'));
        }
        if ($request->header('X-Device-Id')) {

            $device = Device::query()->firstOrCreate(
                [
                    'device_id' => $request->header('X-Device-Id'),
                    'is_mobile' => true,
                ],
                [
                    'app_version' => $request->header('X-App-Version') ?? null,
                    'device_token' => $request->header('X-DeviceToken') ?? null,
                ]
            );

            $request->merge(['device' => $device]);

            if ($request->user('sanctum')) {

                $device->users()->syncWithoutDetaching($request->user('sanctum')->id);
                $user = $request->user('sanctum');
                $user->device_id = $device->device_id;
                $user->device_token = $device->device_token;
                $user->app_version = $device->app_version;
                $user->device_manufacturer = $device->device_manufacturer;
                $user->device_type = $device->device_type;
                $user->save();

            }
        } elseif ($request->header('X-Fingerprint')) {

            $device = Device::where('fingerprint_id', $request->header('X-Fingerprint'))->first();
                if (!$device) {
                    $device = Device::create([
                        'fingerprint_id' => $request->header('X-Fingerprint'),
                    ]);
                }
            $request->merge(['device' => $device]);

            if ($request->user('sanctum')) {

                $device->users()->syncWithoutDetaching($request->user('sanctum')->id);
                $user = $request->user('sanctum');
                $user->device_id = $device->device_id;
                $user->device_token = $device->device_token;
                $user->app_version = $device->app_version;
                $user->device_manufacturer = $device->device_manufacturer;
                $user->device_type = $device->device_type;
                $user->save();

            }
        } else {
            $device = Device::firstOrCreate(
                [
                    'device_id' => 'UNKNOWNDEVICEID',
                    'is_mobile' => true,
                ],
                [
                    'app_version' => $request->header('X-App-Version') ?? null,
                ]
            );

            $request->merge(['device' => $device]);

            if ($request->user('sanctum')) {
                $device->users()->syncWithoutDetaching($request->user('sanctum')->id);
                $user = $request->user('sanctum');

                $user->device_id = $device->device_id;
                $user->device_token = $device->device_token;
                $user->app_version = $device->app_version;
                $user->device_manufacturer = $device->device_manufacturer;
                $user->device_type = $device->device_type;
                $user->save();

            }

        }
        return $next($request);

    }
}
