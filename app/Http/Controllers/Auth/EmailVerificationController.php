<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;

use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponseStatus;
use App\Repositories\UserRepositoryInterface;

class EmailVerificationController extends Controller
{
    use ApiResponseStatus;


    public function __construct(private UserRepositoryInterface $userRepository)
    {
        
    }

    public function action($userId)
    {
        $user = $this->userRepository->find($userId);

        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
            return $this->JsonResponseSuccess('email has been verified', 200);
        }

        return $this->JsonResponseError('bad request', 400);
    }
}
