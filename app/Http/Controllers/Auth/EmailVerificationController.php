<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Services\Auth\EmailVerificationService;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class EmailVerificationController extends Controller
{

    public function __construct(private EmailVerificationService $emailVerificationService, private EmailVerificationRequest $emailVerificationRequest)
    {
        
    }

    public function __invoke()
    {
        return $this->emailVerificationService->action($this->emailVerificationRequest);
    }
}
