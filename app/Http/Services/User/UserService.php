<?php

namespace App\Http\Services\User;

use App\Models\User;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;
use App\Exports\UsersExport;

class UserService
{
    /**
     * uploadimg
     * @param $request, $lastInsertID
     * if input file EXIST $filename, $pathFull be changed by format and save in image_link
     */
    public function uploadimg($request, $lastInsertID)
    {
        if ($request->hasFile('image_link')) {
            try {
                $dt = Carbon::now('Asia/Ho_Chi_Minh')->format('Ymdhis');
                $random = Str::random(7);
                $file = $request->file('image_link');
                $ext = $request->file('image_link')->extension();
                $filename = $dt . '_' . $lastInsertID . '_' . $random . '.' . $ext;
                $pathFull = 'image/users';
                $request->file('image_link')->storeAs('public/' . $pathFull, $filename);
                $find_user = User::find($lastInsertID);
                $find_user->image_link = $pathFull . '/' . $filename;
                $find_user->save();
            } catch (\Exception $error) {
                return false;
            }
        }
    }
    /***
     * handleAdd
     * @param $request
     * get request input and create user new
     */
    public function handleAdd($request)
    {
        try {
            $create = User::create([
                'first_name' => request()->input('first_name'),
                'first_name_hiragana' => request()->input('first_name_hiragana'),
                'last_name' => request()->input('last_name'),
                'last_name_hiragana' => request()->input('last_name_hiragana'),
                'email' => request()->input('email'),
                'password' => bcrypt(request()->input('password')),
                'user_flg' => request()->input('user_flg'),
                'phone' => request()->input('phone'),
                'address' => request()->input('address'),
                'birthday' => Carbon::parse(request()->input('birthday'))->format('Y/m/d'),
                'image_link' => request()->input('image_link'),
                'created_by' => Auth::id()
            ]);
            $lastInsertID = $create->id;
            $this->uploadimg($request, $lastInsertID);
            session()->flash('success', 'Saved successfully.');
        } catch (\Exception $err) {
            session()->flash('error', 'Save failed.');
            return false;
        }
        return true;
    }
    /**
     * getUsers
     * get list user order by desc id
     */
    public function getUsers()
    {
        return User::orderbyDesc('id')->where('del_flg', 0);
    }
    /**
     * getUser
     * get  user where id = parameter user.id
     */
    public function getUser($id)
    {
        return User::where('id', '=', $id)->first();
    }
    /**
     * handleEdit
     * @param $request, $id
     * update user where id = parameter user.id
     */
    public function handleEdit($request, $id)
    {
        try {
            User::where('id', '=', $id)->update([
                'first_name' => request()->input('first_name'),
                'first_name_hiragana' => request()->input('first_name_hiragana'),
                'last_name' => request()->input('last_name'),
                'last_name_hiragana' => request()->input('last_name_hiragana'),
                'email' => request()->input('email'),
                'password' => bcrypt(request()->input('password')),
                'user_flg' => request()->input('user_flg'),
                'phone' => request()->input('phone'),
                'address' => request()->input('address'),
                'birthday' => request()->input('birthday'),
                'updated_by' => Auth::id()
            ]);
            $this->uploadimg($request, $id);
            session()->flash('success', 'Saved successfully.');
        } catch (\Exception $err) {
            session()->flash('error', 'Save failed.');
            return  false;
        }
        return  true;
    }
    /**
     * putSession
     * @param $request
     * set sesion search
     */
    public function putSession($request)
    {
        session([
            'id' => $request->input('id'),
            'first_name' => $request->input('first_name'),
            'first_name_hiragana' => $request->input('first_name_hiragana'),
            'last_name' => $request->input('last_name'),
            'last_name_hiragana' => $request->input('last_name_hiragana'),
            'email' => $request->input('email'),
            'user_flg' => $request->input('user_flg'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address')
        ]);
    }
    /**
     * getUserSearch
     * @param $request
     * get user search
     */
    public function getUserSearch($request)
    {
        $users = User::query()->where('del_flg', 0);
        if ($request->session()->has('id')) {
            $users = $users->where('id', '=', session('id'));
        }
        if ($request->session()->has('first_name')) {
            $users = $users->where('first_name', 'LIKE', '%' . session('first_name') . '%');
        }
        if ($request->session()->has('first_name_hiragana')) {
            $users = $users->where('first_name_hiragana', 'LIKE', '%' . session('first_name_hiragana') . '%');
        }
        if ($request->session()->has('last_name')) {
            $users = $users->where('last_name', 'LIKE', '%' . session('last_name') . '%');
        }
        if ($request->session()->has('last_name_hiragana')) {
            $users = $users->where('last_name_hiragana', 'LIKE', '%' . session('last_name_hiragana') . '%');
        }
        if ($request->session()->has('email')) {
            $users = $users->where('email', '=', session('email'));
        }
        if ($request->session()->has('user_flg')) {
            $users = $users->where('user_flg', '=', session('user_flg'));
        }
        if ($request->session()->has('phone')) {
            $users = $users->where('phone', 'LIKE', '%' . session('phone') . '%');
        }
        if ($request->session()->has('address')) {
            $users = $users->where('address', 'LIKE', '%' . session('address') . '%');
        }
        return $users->orderBy('id', 'asc');
    }
    /**
     * exportUserSearch
     * @param $request
     * 
     */
    public function exportUserSearch($request)
    {
        $users = $this->getUserSearch($request);
        return $users->select("id", "first_name", "last_name", "first_name_hiragana", "last_name_hiragana", "email", "phone", "address", "user_flg", "created_at", "updated_at")->get();
    }
    /**
     * import
     * @param $request
     * import file csv
     */
    public function import($request)
    {
        $dt = Carbon::now('Asia/Ho_Chi_Minh')->format('Ymdhis');
        (new UsersImport('email'))->import($request->file('file')->storeAs('files', $dt . '_user.csv'), null, \Maatwebsite\Excel\Excel::CSV);
        session()->flash('success', 'Saved successfully.');
    }
    /**
     * export
     * @param $users
     * export file csv
     */
    public function export($users)
    {
        $dt = Carbon::now('Asia/Ho_Chi_Minh')->format('Ymdhis');
        $filename = $dt . '_user.csv';
        return Excel::download(new UsersExport($users), $filename);
    }
    /**
     * destroy
     * @param $request
     */

    public function destroy($request)
    {
        $user = User::where('id', $request->input('id'));
        if ($user) {
            $user->update(['deleted_at' => now(), 'deleted_by' => Auth::user()->id, 'del_flg' => 1]);
            return true;
        } else {
            return false;
        }
    }
}
