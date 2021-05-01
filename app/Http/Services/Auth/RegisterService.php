<?php

namespace App\Http\Services\Auth;

use App\Http\Traits\ApiResponseStatus;
use Illuminate\Auth\Events\Registered;
use App\Http\Requests\Auth\RegisterRequest;
use App\Repositories\UserRepositoryInterface;
use App\Http\Resources\User\PrivateUserResource;

class RegisterService
{
    use ApiResponseStatus;
    
    public function __construct(private UserRepositoryInterface $userRepository)
    {
        
    }

    public function action(RegisterRequest $registerRequest)
    {
        $validation = $registerRequest->validated();
        $user = $this->userRepository->create($validation);
        event(new Registered($user));
        return $this->JsonResponseSuccess('you registered successfully', 200, new PrivateUserResource($user->refresh()));
    }
}