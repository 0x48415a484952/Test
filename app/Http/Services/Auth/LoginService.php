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

    public function action(LoginRequest $request)
    {
        $device_name = $request->device_name;
        $user = $this->userRepository->where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.']
            ]);
        }

        if ($device_name === null) {
            $device_name = $request->server('HTTP_USER_AGENT').'/'.$request->ip();
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