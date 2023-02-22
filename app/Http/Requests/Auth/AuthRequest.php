<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Config\Constants\Messages;


class AuthRequest extends FormRequest
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
            'email' =>'required|email',
            'password' =>'required|min:6|max:20'
        ];
    }
    public function messages()
    {
        return [
            'email.required' => Messages::getMessage('E001', ['Email']),
            'email.email' => Messages::getMessage('E004', ['Email']),
            'password.required' => Messages::getMessage('E001', ['Password']),
            'password.min' => Messages::getMessage('E003', ['Password','6']),
            'password.max' => Messages::getMessage('E002', ['Password','20']),
        ];
    }
}
