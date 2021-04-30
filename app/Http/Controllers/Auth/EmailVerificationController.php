<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;

use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponseStatus;

class EmailVerificationController extends Controller
{
    use ApiResponseStatus;

    public function action($userId)
    {
        $user = User::findOrFail($userId);

        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
            return $this->JsonResponseSuccess('email has been verified', 200);
            // return response()->json([
            //     'message' => [
            //         'success' => [ 'email has been verified' ]
            //     ]
            // ], 200);
        }

        return $this->JsonResponseError('bad request', 400);
        // return response()->json([
        //     'message' => [
        //         'error' => [ 'bad request' ]
        //     ]
        // ], 400);
    }
}
