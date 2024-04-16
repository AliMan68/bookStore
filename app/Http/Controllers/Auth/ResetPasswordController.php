<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\VerificationCode;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;



    public function showResetForm(Request $request) {
        return view('auth.passwords.reset');
    }

    public function sendCode(Request $request){
        $request = request();
        $this->validate($request, [
            'captcha' => 'required|captcha'
        ]);
        $mobile = $request->mobile;
        $user = findDuplicateUser($mobile);
        if ($user == null)
            return back()->with('error', 'کاربری با این شماره موبایل یافت نشد')->with('fail', 'کاربری با این شماره موبایل یافت نشد');
        $vc = VerificationCode::generateCode($mobile);
        $token = $vc->token;
        sendResetPasswordCode($mobile, $vc->code);
        return view('auth.passwords.confirm', compact('mobile'));

    }


    public function reset(Request $request){
        $mobile = $request->mobile;
        $code = $request->code;

        $result = VerificationCode::validateCode($mobile, $code);
        if ($result == false)
            return back()->with('fail', 'کد وارد شده اشتباه است');

        $user = findDuplicateUser($mobile);
        if (is_null($user))
            return redirect(route('reset-password.form'))->with('fail', 'کاربر یافت نشد');
        $user->password = Hash::make($user->mobile);
        $user->save();
        return redirect(route('auth.loginForm'))->with('success', 'رمز شما با موفقیت به شماره موبایل شما تغییر یافت');

    }
}
