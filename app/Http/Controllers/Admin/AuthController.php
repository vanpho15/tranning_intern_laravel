<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\AuthRequest;

class AuthController extends Controller
{
    public function index(){
        return view('admin.screen.auth.auth',[
            'title'=>'Login Page'
        ]);
    }
    public function store(AuthRequest $request){
        if(Auth::attempt(['email' => $request->input('email'),
        'password' => $request->input('password'),
        'user_flg' =>0,
        'user_flg' =>0
        ]))
        {
        return redirect()->route('admin.index');
        }else{
            session()->flash('error', 'Email or Password is incorrect');
            return redirect()->back();
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
