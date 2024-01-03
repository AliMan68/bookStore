<?php

namespace App\Http\Controllers;

use App\Helpers\Cart\Cart;
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
        ]);

        $products = $cardItems->mapWithKeys(function ($item){

            return [$item['book']->id => ['quantity'=>$item['quantity'],'price'=>$item['price']]];
        });
        $order->books()->attach($products);



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
        $token = $token = config('services.payping.token');

        $payping = new \PayPing\Payment($token);
        try {
            //amount = $payment->order->price
            if($payping->verify($request->refid, 1000)){
                echo "success";
                $payment->update([
                    'status' => 1
                ]);
                $payment->order->update([
                    'status'=>'paid'
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
                return redirect('/successfullPayment');

            }else{
                echo "fail";
            }
        } catch (Exception $e) {
            return json_decode($e->getMessage());
            echo $e->getMessage();
        }
    }

    public function redirectToSuccessPay(){
        return redirect('successfullPayment',compact());
    }
}
