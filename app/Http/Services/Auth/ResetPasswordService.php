<?php

namespace App\Http\Services\Auth;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Http\Traits\ApiResponseStatus;

class ResetPasswordService
{
    use ApiResponseStatus;

    public function action(ResetPasswordRequest $request)
    {
        $validatedData = $request->validated();
        $result = Password::reset(
            $validatedData,
            function ($user, $password) use ($validatedData) {
                $user->forceFill([
                    'password' => Hash::make($validatedData['password'])
                ])->setRememberToken(Str::random(60));
    
                $user->save();
    
                event(new PasswordReset($user));
            }
        );
        if ($result == Password::INVALID_TOKEN) {
            return $this->JsonResponseError('Invalid token provided', 400);
        }

        return $this->JsonResponseSuccess('password has been changed succefully', 200);
    }
}
