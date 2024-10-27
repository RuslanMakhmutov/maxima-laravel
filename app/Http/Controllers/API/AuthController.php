<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\UserLoginRequest;
use App\Http\Requests\API\UserRegisterRequest;
use App\Services\API\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function register(UserRegisterRequest $request, AuthService $authService): JsonResponse
    {
        $result = $authService->register($request);
        return response()->json($result, 201);
    }

    public function login(UserLoginRequest $request, AuthService $authService): JsonResponse
    {
        $result = $authService->login($request);
        return response()->json($result, $result['status'] ?? 200);
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'success' => true,
            'message' => 'Logout successfully',
        ]);
    }
}
