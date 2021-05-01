<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Services\Auth\LoginService;

class LoginController extends Controller
{
    public function __construct(private LoginService $loginService, private LoginRequest $loginRequest)
    {
    
    }

    public function __invoke()
    {
        return $this->loginService->action($this->loginRequest);
    }
}
