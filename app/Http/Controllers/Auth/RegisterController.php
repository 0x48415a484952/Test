<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\User\PrivateUserResource;
use App\Http\Traits\ApiResponseStatus;

class RegisterController extends Controller
{
    use ApiResponseStatus;

    public function action(RegisterRequest $registerRequest)
    {
        $validation = $registerRequest->validated();
        $user = User::create($validation);
        event(new Registered($user));
        return $this->JsonResponseSuccess('you registered successfully', 200, new PrivateUserResource($user->refresh()));
    }
}
