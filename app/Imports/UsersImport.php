<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;
use App\Rules\CheckMax;
use App\Rules\CheckNumber;
use Config\Constants\Messages;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\Importable;
use App\Rules\CheckHiragana;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

HeadingRowFormatter::default('none');


class UsersImport implements ToModel, SkipsEmptyRows, WithHeadingRow, WithValidation
{
    use Importable;

    public function rules(): array
    {
        
        return [
            'Email' => ['unique:users,email' ,'email:true'],
            'Phone' =>[new CheckNumber('Phone')],
            'Address' => [new CheckMax('Address', 255)],
            'Role' =>['required', 'regex:/0|1/'],
            'First name' => [new CheckMax('First name', 50)],
            'First name hiragana' => [new CheckHiragana('First name Hiragana')],
            'Last name' => [new CheckMax('Last name',50)],
            'Last name hiragna' => [new CheckHiragana('Last name Hiragana')],
        ];
    }
    public function customValidationMessages()
        {
            return [
                'Email.email' => Messages::getMessage('E004', ['Email']),
                'Email.unique' => Messages::getMessage('E021', ['Email']),
                'Role.required' => Messages::getMessage('E001', ['Role']),
                'Role.regex' => Messages::getMessage('E021', ['Role']),
            ];
        }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            'email' => $row['Email'],
            'first_name' => $row['First name'], 
            'last_name' => $row['Last name'],
            'first_name_hiragana' => $row['First name hiragana'],
            'last_name_hiragana' => $row['Last name hiragna'], 
            'phone' => $row['Phone'], 
            'address' => $row['Address'],
            'user_flg'=> $row['Role'], 
            'password'=>''
            ]);
    }
    
}
