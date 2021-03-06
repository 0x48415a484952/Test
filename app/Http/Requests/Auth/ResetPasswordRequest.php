<?php

namespace App\Http\Requests\Auth;

use App\Rules\StrongPassword;
use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'token' => ['required'],
            'email' => ['required', 'email', 'min:1', 'max:255'],
            'password' => ['required', 'string', 'min:10', 'max:255', new StrongPassword()],
            'password_confirmation' => ['required', 'string', 'min:10', 'max:255', 'same:password']
        ];
    }
}
