<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponseStatus;
use Illuminate\Support\Facades\Auth;

class MeController extends Controller
{
    use ApiResponseStatus;
    //for further development situations
    public function action()
    {
        return $this->JsonResponseSuccess(null, 200, Auth::user());
    }
}
