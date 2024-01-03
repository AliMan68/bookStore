<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Cart\Cart;
use App\Http\Controllers\Controller;
use App\Models\DiscountCode;
use Illuminate\Http\Request;

class DiscountCodeController extends Controller
{
    public function index(){
        $codes = DiscountCode::all();
        return view('admin.discount-code.manage',compact('codes'));
    }

    public function store(Request $request){
        $validated_data = \Illuminate\Support\Facades\Validator::make($request->all(),[
            'code'=>'required|min:2|max:6',
            'percent'=>'required|numeric|max:99|min:1',
        ]);

        if ($validated_data->fails()) {
            return back()->with('fail',$validated_data->errors());
            return response(['status' => 'error','message'=>'کد تخفیف/درصد وار شده مجاز نیست']);
        }
        $code = DiscountCode::where('code',$request->code)->first();
        if ($code == null){
            DiscountCode::create([
                'code'=>$request->code,
                'percent'=>$request->percent
            ]);
            return back()->with('success','کد تخفیف با موفقیت ثبت شد ');
        }else
            return back()->with('fail','کد تخفیف با این عنوان قبلا ثبت شده است ');

    }

    public function destroy(DiscountCode $code){
//        $code->orders()->detach();
        $code->deleteOrFail();
        return back()->with('success','کد تخفیف با موفقیت حذف شد ');
    }

    public function checkCode(Request $request){
        $validated_data = \Illuminate\Support\Facades\Validator::make($request->all(),[
            'code'=>'required',
        ]);

        if ($validated_data->fails()) {
            return response(['status' => 'error','message'=>'کد تخفیف مجاز نیست']);
        }
        $code = DiscountCode::where('code',$request->code)->first();
        if ($code != null){
            return response(['status' => 'success','message'=>'کد تخفیف معتبر است','percent'=>$code->percent,'code'=>$code->code]);
        }else{
            return response(['status' => 'error','message'=>'کد تخفیف صحیح نیست']);
        }
    }
}