<?php

namespace App\Http\Services\Auth;

use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\LoginRequest;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Validation\ValidationException;
use App\Http\Resources\User\PrivateUserResource;

class LoginService
{
    public function __construct(private UserRepositoryInterface $userRepository)
    {
        
    }

    public function action(LoginRequest $loginRequest)
    {
        $validated = $loginRequest->validated();
        $device_name = $loginRequest->device_name;
        $user = $this->userRepository->where('email', $validated['email'])->first();

        if (! $user || ! Hash::check($validated['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.']
            ]);
        }

        if ($device_name === null) {
            $device_name = $loginRequest->server('HTTP_USER_AGENT').'/'.$loginRequest->ip();
        }

        $token = $user->createToken($device_name)->plainTextToken;

        return (new PrivateUserResource($user))
            ->additional([
                'meta' => [
                    'token' => $token,
                    'type' => 'bearer'
                ]
            ]);
    }
}