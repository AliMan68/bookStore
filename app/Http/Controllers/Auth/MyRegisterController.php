<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\VerificationCode;
use Illuminate\Http\Request;

class MyRegisterController extends Controller
{
  public function __construct() {
    $this->middleware('guest');
  }


  public function registerMobile(){
    return view('auth.register-send-code');
  }

  public function sendCode(Request $request){
      $request = request();
      $this->validate($request, [
          'captcha' => 'required|captcha'
      ]);


    $mobile = $request->mobile;
    $user = findDuplicateUser($mobile);
    if ($user != null)
      return back()->with('error', 'این شماره موبایل قبلا در سیستم ثبت شده است.')->with('fail', 'این شماره موبایل قبلا در سیستم ثبت شده است.');

    $vc = VerificationCode::generateCode($mobile);
    $token = $vc->token;
    sendRegisterPasswordCode($mobile, $vc->code);

    $fail = '';

    return view('auth.register-confirm-code', compact('mobile', 'token', 'fail'));

  }

  public function verifyMobile(Request $request){
    $mobile = $request->mobile;
    $token = $request->mobile_token;
    $code = $request->code;

    $result = VerificationCode::validateCode($mobile, $code);
    if ($result == false) {
      $fail = 'کد وارد شده اشتباه است';
      return view('auth.register-confirm-code', compact('mobile', 'token', 'fail'))->with('fail', 'کد وارد شده اشتباه است');
    }
    return redirect(route('auth.register') . '?mobile_token='.$token . '&mobile=' . $mobile);
  }
}
