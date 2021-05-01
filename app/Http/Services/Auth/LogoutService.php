<?php

namespace App\Http\Services\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Traits\ApiResponseStatus;

class LogoutService
{
    use ApiResponseStatus;

    public function action()
    {
        if (Auth::user()->currentAccessToken()->delete()) {
            return $this->JsonResponseSuccess('token deleted successfully', 200);
        } 
        
    }
}