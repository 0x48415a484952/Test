<?php

namespace App\Http\Services\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Traits\ApiResponseStatus;

class EmailVerificationResendService
{
    use ApiResponseStatus;
    
    public function __construct()
    {
        
    }

    public function action()
    {
        if (Auth::user()->hasVerifiedEmail()) {
            return $this->JsonResponseError('email has been already verified', 400);

        }

        Auth::user()->sendEmailVerificationNotification();
    }
}