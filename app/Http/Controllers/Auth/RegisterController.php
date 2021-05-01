<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Services\Auth\RegisterService;

class RegisterController extends Controller
{
    public function __construct(private RegisterService $registerService, private RegisterRequest $registerRequest)
    {
        
    }

    public function __invoke()
    {
        return $this->registerService->action($this->registerRequest);
    }

}
