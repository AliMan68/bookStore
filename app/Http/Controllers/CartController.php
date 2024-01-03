<?php

namespace App\Http\Controllers;


use App\Helpers\Cart\Cart;
use App\Models\Book;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Book $book){
//        return session()->get('cart');

        if(!Cart::has($book)){
            Cart::put([
                'id'=>'1',
                'quantity'=>1,
                'price'=>$book->price
            ],$book) ;
            return back()->with('success','کتاب با موفقیت به سبد خرید اضافه شد');
        }
        return 'Wrong!';
    }

    public function checkoutList(){
        $cart = Cart::all();
        return view('site.checkout',compact('cart'));
    }


    public function quantityChange(Request $request){


        $data = $request->validate([
            'quantity'=>'required',
            'id'=>'required',
            'type'=>'required',
        ]);
        //real time stock entity
        $stockEntity = Cart::get($data['id'],true)['book']->count;

        //this variable calculate current item count with sent count depend on is 'add' or 'minus'
        $orderCount = $data['type'] == 'add' ? ($data['quantity'] + Cart::get($data['id'])['quantity']): (Cart::get($data['id'])['quantity'] - $data['quantity'] );

        //check stock count before add to cart(is book available?)
        if ($data['quantity'] < 1){
            return response(['status' => 'error','message'=>'حداقل تعداد سفارش یک کتاب می‌باشد!']);
        }
        if ($stockEntity < $orderCount){
            return response(['status' => 'error','message'=>'به حداکثر تعداد سفارش رسیده‌اید']);
        }
        if (Cart::has($data['id'])){
            Cart::update($data['id'],$data);
            $totalPrice= number_format(Cart::totalPrice());
            return response(['status' => 'success','message'=>'تعداد با موفقیت بروز شد','quantity'=>$orderCount,'total_price'=>$totalPrice]);
        }
        return response(['status' => 'error','message'=>'محصول در سید خرید یافت نشد!'],404);


    }

    public function deleteFromCart($id){
        if (Cart::delete($id)){
            return back()->with('success','کتاب با موفقیت از سبد خرید حذف شد');
        }else{
            return back()->with('fail','کتاب در سبد خرید موجود نیست');
        }
    }
}
