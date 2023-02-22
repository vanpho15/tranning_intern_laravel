<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\User\UserService;
use App\Http\Requests\User\AddRequest;
use App\Http\Requests\User\EditRequest;
use App\Http\Requests\User\ImportRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Common\Paginate;

class UserController extends Controller
{

    protected $userservice;
    public function __construct(UserService $userservice)
    {
        $this->userservice = $userservice;
    }
    /**
     * add 
     * return view add user and Passing params title
     */
    public function add()
    {
        return view('admin.screen.user.user-add', [
            'title' => 'Users Add'
        ]);
    }
    /**
     * Handle add 
     * @param $request
     * call functions handleAdd from userservice. and Passing params $request
     */
    public function handleAdd(AddRequest $request)
    {
        $this->userservice->handleAdd($request);
        return redirect()->route('user.listUser');
    }
    /**
     * listUser
     * return view user-list and Passing params users will assign the value call functions getUsers from userservice
     */
    public function listUser()
    {
        return view('admin.screen.user.user-list', [
            'title' => 'User Search',
            'users' => Paginate::paginate($this->userservice->getUsers(), config('constants.global.pagination_records')),
            'userLogin' => Auth::id()
        ]);
    }
    /**
     * edit
     * @param $id
     * return view user-edit and Passing params id in function user-edit to get user edit
     */
    public function edit($id)
    {
        return view('admin.screen.user.user-edit', [
            'title' => 'Users Edit',
            'user' => $this->userservice->getUser($id)
        ]);
    }
    /**
     * 
     * handleEdit
     * @param $request, $id
     *get user edit to compare the conditions.if function has fulfilled the condition. call function handleEdit in userservice
     */
    public function handleEdit(EditRequest $request, $id)
    {
        $user = $this->userservice->getUser($id);
        $userEdit = $user->user_flg;
        if ($id != Auth::id() && $userEdit == 0) {
            return redirect()->route('error.forbidden');
        } else {
            $this->userservice->handleEdit($request, $id);
            return redirect()->back();
        }
    }
    /**
     * import
     * @param $request
    
     */
    public function import(ImportRequest $request)
    {
        if ($request->hasFile('file')) {
            $this->userservice->import($request);
            return redirect()->back();
        } else {
            session()->flash('error', 'File does not exist.');
            return redirect()->back();
        }
    }
    /**
     * export
     * @param $request
     *
     */
    public function export(Request $request)
    {
        $users = $this->userservice->exportUserSearch($request);
        return $this->userservice->export($users);
    }
    /**
     * search
     * @param $request
     *
     */
    public function search(Request $request)
    {
        $this->userservice->putSession($request);
        return view('admin.screen.user.user-list', [
            'title' => 'User Search',
            'users' => Paginate::paginate($this->userservice->getUserSearch($request), config('constants.global.pagination_records')),
            'userLogin' => Auth::id()
        ]);
    }
    /**
     * forgetSessionSearch
     * @param $request
     *
     */
    public function forgetSessionSearch(Request $request)
    {
        $request->session()->forget(['id', 'first_name', 'first_name_hiragana', 'last_name', 'last_name_hiragana', 'email', 'user_flg', 'phone', 'address']);
        return view('admin.screen.user.user-list', [
            'title' => 'User search',
            'users' => Paginate::paginate($this->userservice->getUserSearch($request), config('constants.global.pagination_records')),
            'userLogin' => Auth::id()
        ]);
    }

    /**
     * destroy
     * @param $request
     */
    public function destroy(Request $request)
    {
        $result = $this->userservice->destroy($request);
        if ($result) {
            return response()->json([
                'error' => false,
            ]);
        } else {
            return response()->json([
                'error' => true
            ]);
        }
    }
}
