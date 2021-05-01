<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Http\Services\Auth\ResetPasswordService;

class ResetPasswordController extends Controller
{
    public function __construct(private ResetPasswordService $resetPasswordService, private ResetPasswordRequest $resetPasswordRequest)
    {
        
    }

    public function __invoke()
    {
        $this->resetPasswordService->action($this->resetPasswordRequest);
    }
}
