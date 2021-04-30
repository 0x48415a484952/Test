<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Validation\ValidationException;
use App\Http\Resources\User\PrivateUserResource;

class LoginController extends Controller
{
    public function action(LoginRequest $loginRequest)
    {
        $loginRequest->validated();
        $device_name = $loginRequest->device_name;
        $user = User::where('email', $loginRequest->email)->first();

        if (! $user || ! Hash::check($loginRequest->password, $user->password)) {
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
