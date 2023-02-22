<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Config\Constants\Messages;
use App\Rules\CheckMax;
use App\Rules\CheckAlphaNum;
use App\Rules\CheckNumber;
use App\Rules\CheckHiragana;




class AddRequest extends FormRequest
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
            'name' => ['required', new CheckMax('Name', config('constants.global.checkmax_100'))],
            'name_kana' => ['required', new CheckMax('Product name kana', config('constants.global.checkmax_100')), new CheckHiragana('Product name kana')],
            'alias' => ['required', new CheckMax('Alias', config('constants.global.checkmax_100')), new CheckAlphaNum('Alias')],
            'content' => [new CheckMax('cONTENT', 2000)],
            'amount' => ['required', new CheckMax('Amount', 6), new CheckNumber('Amount')],
            'price' => ['required', new CheckMax('Price', 20), new CheckNumber('Price')],
            'image_link' => ['required'],
            'category_id' => ['required'],
        ];
    }
    public function messages()
    {
        return [
            'name.required' => Messages::getMessage('E001', ['Name']),
            'name_kana.required' => Messages::getMessage('E001', ['Product name kana']),
            'alias.required' => Messages::getMessage('E001', ['Alias']),
            'amount.required' => Messages::getMessage('E001', ['Amount']),
            'price.required' => Messages::getMessage('E001', ['Price']),
            'image_link.required' => Messages::getMessage('E001', ['Product image']),
            'category_id.required' => Messages::getMessage('E001', ['Category name']),
        ];
    }
}
