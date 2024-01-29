<?php

namespace App\Http\Controllers;

use App\Helpers\Cart\Cart;
use App\Models\Book;
use App\Models\Order;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrderController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:manage-orders',['except' => ['userOrders']]);
        $this->middleware('can:manage-report',['only' => ['report']]);
        $this->middleware('can:user-orders',['only' => ['userOrders']]);
    }

    public function userOrders(){

//        $orders = auth()->user()->orders();
        $orders = Order::query();
//        $orders = $orders->where('status','=','completed')->orWhere('status','=','delivered');
        $orders = $orders->where('user_id','=',auth()->user()->id)->paginate(30);

        return view('admin.user-orders',compact('orders'));
    }

    //repay user unpaid orders
    public function payment(Order $order){
        return $order;
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

    public function index(Request $request){
        $orders = Order::query();
        if ($search = request('search')) {
            $orders->where('status',request('type'));


            //orWhereHas = search inside relations
            $orders->where('id',$search)->orWhereHas('user', function ($query) use ($search) {
                $query->where('name', 'like', "%$search%");
            });
        }

//        dd($orders->where('status',request('type'))->get()->count());
        $orders = $orders->where('status',request('type'))->latest()->paginate(30);

        return view('admin.orders.index',compact('orders'));
    }

    public function deliverOrder(Request $request,Order $order){

        try {

            ($request->tracking_code != null) ? $order->tracking_code = $request->tracking_code:$order->tracking_code = null;
            $order->status = 'delivered';
            $order->save();
            return redirect(url('admin/orders?type=completed&search='))->with('success','سفارش با موفقیت تحویل/ارسال شد');

        } catch (\Exception $e) {
//            return $e->getMessage();
            return redirect(url('admin/orders?type=completed&search='))->with('fail',$e->getMessage());
        }
    }


    public function report(Request $request){

        $fromDate = toGeorgianDate($request->from_date);
        $toDate = toGeorgianDate($request->to_date);
        $title = $request->title;

        $books = Book::query();
        $books = (!is_null($title)) ? $books->where('title','like','%'.$title.'%') : $books ;

        if ($books->get()->count() > 0){

            $orders = collect();
            $orderDetails = collect();
            foreach ($books->get() as $book){
                //sort each book order by received date
                $orders = $book->orders()->where('status','!=','unpaid')->get();


                if ($fromDate != null)
                    $orders = $orders->where('created_at','>=',$fromDate);
                if ($toDate != null)
                    $orders = $orders->where('created_at','<=',$toDate);

                //create a collection of book title and sum of it's order


                $orderDetails[$book->title] = $orders->mapWithKeys(function ($item) use ($book){
                    //calculate book count multiple book price at order time
                    return [$item->id =>['quantity' => $item->pivot->quantity ,'total_price'=>$item->pivot->price * $item->pivot->quantity]];
                });
            }
//            dd($orderDetails);
        }
        return view('admin.report',compact('orderDetails','title','fromDate','toDate'));
        $orders = Order::query();
//
//        if (count($books_id) > 0){
//            $books =
//        }



    }

}
