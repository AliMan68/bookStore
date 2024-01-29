<?php

namespace App\Http\Controllers;

use App\Helpers\Cart\Cart;
use App\Models\DiscountCode;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PaymentController extends Controller
{

    public function payment(Request $request){

//        $data = $request->validate([
//            'receiver_name'=>['required','string'],
//            'receiver_number'=>['required'],
//        ]);

        $validated_data = \Illuminate\Support\Facades\Validator::make($request->all(),[
            'receiver_name'=>['required','string'],
            'receiver_number'=>['required'],
        ]);

        if ($validated_data->fails()) {
            return back()->with('fail','درج نام و شماره دریافت کننده سفارش اجباری است ');
        }

        $cardItems = Cart::all();

//        $totalPrice = $cardItems->sum(function ($item){
//            return $item['quantity'] * $item['book']->price;
//        });
        $totalPrice = Cart::totalPrice();

        //validate discount code add calculate total price
        $discountCodeId = null;
        if (!is_null($request->discount_code_value)){
            //extract code from DB
            $discountCodeId = DiscountCode::where('code',$request->discount_code_value)->first()->id;
            $discountCodePercent = DiscountCode::where('code',$request->discount_code_value)->first()->percent;
            $totalPrice = $totalPrice - ($totalPrice * $discountCodePercent/100);
        }

        $order = $request->user()->orders()->create([
            'price'=>$totalPrice,
            'status'=>'unpaid',
            'receiver_name'=>$request->receiver_name,
            'receiver_number'=>$request->receiver_number,
            'receiver_state'=>$request->receiver_state,
            'receiver_city'=>$request->receiver_city,
            'receiver_postal_code'=>$request->receiver_postal_code,
            'receiver_address'=>$request->receiver_address,
            'delivery_type'=>$request->delivery_type,
            'discount_code_id'=>$discountCodeId,
        ]);

        $products = $cardItems->mapWithKeys(function ($item){

            return [$item['book']->id => ['quantity'=>$item['quantity'],'price'=>$item['price']]];
        });
        $order->books()->attach($products);

//after create order and it's items,next is payment

        $token = config('services.payping.token');
        $res_number = Str::random();
        $args = [
            "amount" => '1000',
            "payername" => auth()->user()->name,
            "returnUrl" => route('payment.callback'),
            "clientRefId" => $res_number
        ];

        $payment = new \PayPing\Payment($token);

        try {
            $payment->pay($args);
        } catch (Exception $e) {
            return back()->with($e->getMessage());
            throw $e;
        }
        //add order to payment table -to check it with received resnumber from bank
        $order->payments()->create([
            'resnumber'=>$res_number,
            'price'=>$totalPrice
        ]);

        return redirect($payment->getPayUrl());
    }


    public function callback(ًRequest $request){

        $payment = Payment::where('resnumber','=',$request->clientrefid)->firstOrFail();
        $token = config('services.payping.token');

        $payping = new \PayPing\Payment($token);
        try {
            //amount = $payment->order->price
            if($verify = $payping->verify($request->refid, 1000)){
                echo "success";
                $payment->update([
                    'status' => 1
                ]);
                $payment->order->update([
                    'status'=>'completed'
                ]);

                //update inventory and redirect to success page
                foreach ($payment->order->books()->get() as $book){

                    $currentItemCount = $book->count;
                    $orderItemCount = Cart::get($book)['quantity'];
                    $book->update([
                        'count'=> $currentItemCount - $orderItemCount
                    ]);
                    $book->save();
                }

                //clean cart after payment completed
                Cart::flush();
                return view('site.successful-payment',compact('verify'));

            }else{
                $error = 'تراکنش نا موفق بود در صورت کسر مبلغ از حساب شما حداکثر پس از 72 ساعت مبلغ به حسابتان برمی گردد';
                return view('site.failed-payment',compact('error'));
            }
        } catch (Exception $e) {
            return json_decode($e->getMessage());
            echo $e->getMessage();
        }
    }
}
