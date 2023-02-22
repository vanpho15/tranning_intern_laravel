<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Config\Constants\Messages;
use Illuminate\Validation\Rules\File;
use App\Rules\CheckAlphaNum;
use App\Rules\CheckNumber;
use App\Rules\CheckMax;
use App\Rules\CheckHiragana;


class EditRequest extends FormRequest
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
            'first_name' => ['required',new CheckMax('First name', 50)],
            'first_name_hiragana' => ['required',new CheckMax('First name Hiragana',50), new CheckHiragana('First name Hiragana')],
            'last_name' => ['required',new CheckMax('Last name',50)],
            'last_name_hiragana' => ['required',new CheckMax('Last name Hiragana',50), new CheckHiragana('Last name Hiragana')],
            'email' => ['required',new CheckMax('Email', 75),'email:true'],
            'user_flg' => ['required'],
            'phone' => ['nullable',new CheckMax('Phone', 11),new CheckNumber('Phone')],
            'address' => [new CheckMax('Address', 225)],
            'password' => [new CheckMax('Password', 100), new CheckAlphaNum('Password') ],
            're-password'=> ['same:password',new CheckAlphaNum('Re-Password')],
            'image_link' => ['mimes:jpeg,png,jpg','max: 5120'],
            'birthday' =>['nullable','date','date_format:Y/m/d','before:now'],
        ];
    }
    public function messages()
    {
        return [
            'first_name.required' => Messages::getMessage('E001', ['First name']),
            'last_name.required' => Messages::getMessage('E001', ['Last name']),
            'first_name_hiragana.required' => Messages::getMessage('E001', ['First name Hiragana']),
            'last_name_hiragana.required' => Messages::getMessage('E001', ['Last name Hiragana']),
            'email.required' => Messages::getMessage('E001', ['Email']),
            'email.email' => Messages::getMessage('E004', ['Email']),
            'user_flg.required' => Messages::getMessage('E001', ['Role']),
            're-password.same' => Messages::getMessage('E011'),
            'image_link.mimes' => Messages::getMessage('E007', ['png, jpg, jpeg']),
            'image_link.max' => Messages::getMessage('E005', ['5MB']),
            'birthday.date' => Messages::getMessage('E017', ['Birthday']),
            'birthday.after' => Messages::getMessage('E017', ['Birthday']),
            'birthday.date_format' => Messages::getMessage('E012', ['Birthday','','Date'])
            
        ];
    }
}