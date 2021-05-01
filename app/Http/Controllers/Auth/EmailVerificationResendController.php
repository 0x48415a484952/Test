<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponseStatus;
use Illuminate\Support\Facades\Auth;

class EmailVerificationResendController extends Controller
{
    use ApiResponseStatus;

    public function action()
    {

        if (Auth::user()->hasVerifiedEmail()) {
            return $this->JsonResponseError('email has been already verified', 400);

        }

        Auth::user()->sendEmailVerificationNotification();
    }
}
