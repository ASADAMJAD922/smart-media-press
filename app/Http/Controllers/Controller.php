<?php

namespace App\Http\Controllers;

abstract class Controller
{
    protected function formatResponse($status, $message = null, $data = null, $code = 200): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'status' => $status,
            'message' => $message ? strtolower(str_replace(" ", "-", $message)) : null,
            'data' => $data,
        ], $code);
    }
}
