<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Services\Auth\ForgotPasswordService;

class ForgotPasswordController extends Controller
{
    public function __construct(private ForgotPasswordService $forgotPasswordService, private LoginRequest $loginRequest)
    {
        
    }

    public function __invoke()
    {
        return $this->forgotPasswordService->action($this->loginRequest);
    }
}
