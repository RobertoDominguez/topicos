<?php

namespace App\Http\Controllers;

use App\Models\Administrator;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;

class AdministratorController extends Controller
{
    public function view_login(){
        return view('administrator.login');
    }

    public function login(Request $request){
        $credentials=$this->validate($request,[
            'email'=>'required',
            'password'=>'required'
        ]);


        if (Auth::guard('web')->attempt($credentials)){
            return redirect()->route('users');
        }
        return back()->withErrors(['error'=>'datos invalidos']);
    }

    public function logout(){
        Auth::guard('web')->logout();
        return back();
    }

    public function users(){
        $users=User::where('accepted',false)->where('rejected',false)->get();
        return view('administrator.users',compact('users'));
    }

    public function accept($id_user){
        User::find($id_user)->update(['accepted'=>true]);
        return redirect()->route('users');
    }

    public function reject($id_user){
        User::find($id_user)->update(['rejected'=>true]);
        return redirect()->route('users');
    }

}
