<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    //

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
            $usernameType = 'invalid';;
        }

        //validate password after check username type
        $request->validate([
            'password'=>['required', 'string', 'min:8']
        ]);



        switch ($usernameType){
            case 'email':
               //login with email
                $request->validate([
                    'username'=>['required','string']
                ]);

                //try to login user
                if (auth()->attempt(array('email'=>$request->username,'password'=>$request->password)))
                    return redirect()->intended('books/index');
                else
                    return redirect()->back()->with('fail','خطایی در ورود رخ داده است');
                break;
            case 'phone':
                $request->validate([
                    'username'=>['required','string']
                ]);
                //login with phone
                    return 'username type is : '. $usernameType;
                break;
            default:
                 return back();
        }
    }
}
