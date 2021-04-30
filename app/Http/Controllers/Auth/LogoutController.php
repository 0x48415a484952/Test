<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponseStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    use ApiResponseStatus;

    public function action()
    {
        if (Auth::user()->currentAccessToken()->delete()) {
            return $this->JsonResponseSuccess('token deleted successfully', 200);
        } 
        
    }
}
