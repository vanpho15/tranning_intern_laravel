<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;
use Config\Constants\Messages;
use App\Rules\CheckMax;



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
            'name' => ['required',new CheckMax('Name', 100)],
            'alias' => ['required',new CheckMax('Alias', 100)],
        ];
    }
    public function messages()
    {
        return [
            'name.required' => Messages::getMessage('E001', ['Name']),
            'alias.required' => Messages::getMessage('E001', ['Alias']),
        ];
    }
}