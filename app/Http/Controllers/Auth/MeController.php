<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Services\Auth\MeService;

class MeController extends Controller
{
    public function __construct(private MeService $meService)
    {
        
    }

    public function __invoke()
    {
        return $this->meService->action();
    }
}
