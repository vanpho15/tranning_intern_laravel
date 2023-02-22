<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;


class UsersExport implements FromCollection,  WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection

    */
    protected $users;
    public function __construct($users)
    {
        $this->users = $users;
    }
    public function collection()
    {
        return $this->users;
    }
    public function headings() :array {
    	return ["ID", "First Name", "Last Name", "First name hiragana","Last name hiragna","Email","Phone","Address","Role","Created Date","Updated Date"];
    }
    public function map($users): array
    {
        return [
            $users->id,
            $users->first_name,
            $users->last_name,
            $users->first_name_hiragana,
            $users->last_name_hiragana,
            $users->email,
            $users->phone,
            $users->address,
            $users->user_flg,
            $users->created_at,
            $users->updated_at
        ];
    }
    

}
