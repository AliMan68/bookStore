<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use App\Models\VerificationCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:manage-profile')->only(['editProfile','update']);
    }

    public function showRegisterForm(){
        if (!isset($_GET['mobile']) || !isset($_GET['mobile_token']))
            return redirect(route('register.mobile'));
        return view('auth.new-register');
    }
    public function register(Request $request){
//        $data = $request->validate([
//            'name'=>['required','string','max:255','min:3'],
//            'phone'=>['required','string','regex:/^09(1[0-9]|3[1-9]|2[1-9])-?[0-9]{3}-?[0-9]{4}$/','unique:users,phone'],
//            'email'=>['required','email','unique:users','string'],
//            'password'=>['required', 'string', 'min:8', 'confirmed'],
//        ]);

        $request = request();
        $this->validate($request, [
            'captcha' => 'required|captcha'
        ]);

        $mobile = $request->mobile;
        $token = $request->mobile_token;
        $result = VerificationCode::validateToken($token, $mobile);
        if ($result == false) {
            return back()->with('failed','خطایی در ثبت نام رخ داده است');
        }

        $user = findDuplicateUser($mobile);
        if ($user != null) {
            return back()->with('failed','این شماره موبایل قبلا در سامانه ثبت شده است');
        }


        $validated_data = \Illuminate\Support\Facades\Validator::make($request->all(),[
            'name'=>['required','string','max:255','min:3'],
//            'mobile'=>['required','string','regex:/^09(1[0-9]|3[1-9]|2[1-9])-?[0-9]{3}-?[0-9]{4}$/','unique:users,phone'],
            'mobile'=>['required'],
            'email'=>['required','email','unique:users','string'],
            'password'=>['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validated_data->fails()) {
            return back()->with('fail',$validated_data->errors());
        }
//        $validated_captcha = \Illuminate\Support\Facades\Validator::make($request->all(),[
//            'captcha' => 'required|captcha'
//        ]);

//        if ($validated_captcha->fails()) {
//            return back()->with('fail','کد کپجا وارد شده صحیح نیست');
//        }

        try {
            $user = User::create([
                'name'=>$request->name,
                'phone'=>$mobile,
                'email'=>$request->email,
                'is_staff'=>1,
                'password'=>Hash::make($request->password),
            ]);
            $role = Role::whereTitle('کاربر')->get()->first();
//            dd($role->id);
            $user->roles()->attach($role->id);
            return redirect(route('auth.login'))->with('success','ثبت نام با موفقیت انجام شد');
        }catch (\Exception $e){
            return back()->with('failed','خطایی در ثبت نام رخ داده است');
        }

        return redirect(route('auth.login'));
    }

    public function editProfile(){
        return view('admin.profile');
    }

    public function update(Request $request,User $user){
        $validated_data = \Illuminate\Support\Facades\Validator::make($request->all(),[
            'name'=>['required','string','max:255','min:3'],
//            'phone'=>['required','string','regex:/^09(1[0-9]|3[1-9]|2[1-9])-?[0-9]{3}-?[0-9]{4}$/'],
//            'email'=>['required','email','string'],
            'password'=>['string', 'min:8', 'confirmed','nullable'],
        ]);
        if ($validated_data->fails()) {
            return back()->with('fail',$validated_data->errors());
        }
        //check if email or phone is already taken
//        if ($this->emailPhoneConflict($request->email,$request->phone,auth()->user()))
//            return back()->with('fail','شماره تماس یا ایمیل قبلا در سامانه ثبت شده است.');


        $user->update([
            'name'=>$request->name,
//            'phone'=>$request->phone,
//            'email'=>$request->email,
        ]);
        if($request->password) {
            $user->password = Hash::make($request->password);
            $user->save();
        }
        return back()->with('success','اطلاعات کاربری با موفقیت ویرایش شد');
    }

    public function emailPhoneConflict($email,$phone,$currentUser){
        if ($email == $currentUser->email && $phone == $currentUser->phone)
            return false;

        $user = User::where('email','=',$email)->where('phone','=',$phone)->get()->first();
//            dd($user);
        if ($user != null){
            return true;
        }


    }
}
