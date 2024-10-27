<?php

namespace App\Services\API;

use App\Http\Requests\API\UserLoginRequest;
use App\Http\Requests\API\UserRegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthService
{

    public function register(UserRegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => trim(strtolower($request->email)),
            'password' => bcrypt($request->password),
        ]);

        return [
            'success' => true,
            'message' => 'User created successfully',
            'user' => [
                'id' => $user->id,
                "name" => $user->name,
                "email" => $user->email
            ]
        ];
    }

    public function login(UserLoginRequest $request): array
    {
        try {
            $this->checkUser($request);
            return $this->generateToken();
        } catch (ValidationException $e) {
            return [
                'success' => false,
                'status' => 422,
                'message' => $e->getMessage()
            ];
        }
    }

    public function checkUser(UserLoginRequest $request): void
    {
        if (!Auth::attempt($request->validated())) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
    }

    public function generateToken(): array
    {
        $user = Auth::user();
        return [
            'success' => true,
            'token' => $user->createToken('RestAPI', ['*'], now()->addMonth())->plainTextToken,
            'name' => $user->name,
        ];
    }
}
