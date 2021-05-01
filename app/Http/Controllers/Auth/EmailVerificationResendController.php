<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Services\Auth\EmailVerificationResendService;

class EmailVerificationResendController extends Controller
{
    public function __construct(private EmailVerificationResendService $emailVerificationResendService)
    {
        
    }

    public function __invoke()
    {
        return $this->emailVerificationResendService->action();
    }
}
