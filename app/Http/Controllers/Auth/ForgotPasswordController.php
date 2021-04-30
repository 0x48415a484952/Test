<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Http\Traits\ApiResponseStatus;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    use ApiResponseStatus;

    public function action(ForgotPasswordRequest $request)
    {
        $validatedData = $request->validated();
        Password::sendResetLink($validatedData);
        return $this->JsonResponseSuccess('Reset password link sent to your email address.');
    }
}
