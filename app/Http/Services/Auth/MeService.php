<?php

namespace App\Http\Services\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Traits\ApiResponseStatus;

class MeService
{
    use ApiResponseStatus;

    public function action()
    {
        return $this->JsonResponseSuccess(null, 200, Auth::user());
    }
}