<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    //

    public function showConfirmCode(){
        return view('auth.confirm-code');
    }

    public function showLoginForm(){

        return view('auth.new-login');
    }

    public function login(Request $request){
        $usernameType = "";
        $emailPattern = '/^\w{2,}@\w{2,}\.\w{2,4}$/';
        $phonePattern = '/^09(1[0-9]|3[1-9]|2[1-9])-?[0-9]{3}-?[0-9]{4}$/';

        if(preg_match($emailPattern,$request->username)){
            $usernameType = 'email';
        }
        elseif (preg_match($phonePattern,$request->username)){
            $usernameType = 'phone';
        }else{
            $usernameType = 'invalid';
        }

//        $validated_captcha = \Illuminate\Support\Facades\Validator::make($request->all(),[
//            'captcha' => 'required|captcha'
//        ]);
//
//        if ($validated_captcha->fails()) {
//            return back()->with('fail','کد کپجا وارد شده صحیح نیست');
//        }


        switch ($usernameType){
            case 'email':
                $validated_data = \Illuminate\Support\Facades\Validator::make($request->all(),[
                    'username'=>['required','string']
                ]);
                if ($validated_data->fails()) {
                    return back()->with('fail',$validated_data->errors());
                }
                //try to login user
                if (auth()->attempt(array('email'=>$request->username,'password'=>$request->password)))
                    return redirect()->intended('/');
                else
                    return redirect()->back()->with('fail','نام کاربری یا ایمیل صحیح نیست');
                break;
            case 'phone':

                $validated_data = \Illuminate\Support\Facades\Validator::make($request->all(),[
                    'username'=>['required','string']
                ]);

                if ($validated_data->fails()) {
                    return back()->with('fail',$validated_data->errors());
                }
                //login with phone
                if (auth()->attempt(array('phone'=>$request->username,'password'=>$request->password)))
                    return redirect()->intended('/');
                else
                    return redirect()->back()->with('fail','نام کاربری یا ایمیل صحیح نیست');
                break;
            default:
                return redirect()->back()->with('fail','فرمت شماره همراه یا ایمیل صحیح نیست');
        }
    }
}
