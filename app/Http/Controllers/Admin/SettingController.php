<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index(){
        $setting = Setting::latest()->first();
        return view('admin.setting',compact('setting'));
    }
    public function store(Request $request){
        $validated_data = \Illuminate\Support\Facades\Validator::make($request->all(),[
            'system_name'=>'required|string|max:256',
            'persons'=>'max:256',
            'address'=>'required|string|max:256',
            'phone'=>'required|string|max:256',
            'email'=>'max:256',
        ]);
        if ($validated_data->fails()) {
            return back()->with('fail',$validated_data->errors());
        }
//        Setting::truncate();
        Setting::create([
            'system_name'=>$request->system_name,
            'persons'=>$request->persons,
            'address'=>$request->address,
            'phone'=>$request->phone,
            'email'=>$request->email,
        ]);
        return back()->with('success','تغییرات با موفقیت اعمال شد');
    }
}
