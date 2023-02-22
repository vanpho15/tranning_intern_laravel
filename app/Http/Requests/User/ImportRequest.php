<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Config\Constants\Messages;
use Illuminate\Validation\Rules\File;



class ImportRequest extends FormRequest
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
            'file' => ['file', 'mimes:csv,txt'],
        ];
    }
    public function messages()
    {
        return [
            'file.mimes' => Messages::getMessage('E007', ['csv']),

        ];
    }
}
