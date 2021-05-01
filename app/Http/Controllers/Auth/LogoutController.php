<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Services\Auth\LogoutService;

class LogoutController extends Controller
{
    public function __construct(private LogoutService $logoutService)
    {
        
    }

    public function __invoke()
    {
        return $this->logoutService->action();
    }
}
