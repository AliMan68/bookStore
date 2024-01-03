<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegisterForm(){
        return view('auth.register');
    }
    public function register(Request $request){
        $data = $request->validate([
            'name'=>['required','string','max:255','min:3'],
            'phone'=>['required','string','regex:/^09(1[0-9]|3[1-9]|2[1-9])-?[0-9]{3}-?[0-9]{4}$/','unique:users,phone'],
            'email'=>['required','email','unique:users','string'],
            'password'=>['required', 'string', 'min:8', 'confirmed'],
        ]);
        User::create([
            'name'=>$data['name'],
            'phone'=>$data['phone'],
            'email'=>$data['email'],
            'is_staff'=>1,
            'password'=>Hash::make($data['password']),
        ]);
        return redirect(route('auth.login'));
    }
}
