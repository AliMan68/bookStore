<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Deliver;
use App\Models\OtherSales;
use Illuminate\Http\Request;

class OtherSalesController extends Controller
{


    public function __construct()
    {
        $this->middleware('can:manage-other-sale');
    }
    public function index(){
        $sales = OtherSales::all();
        $books = Book::all();
        return view('admin.other-sale.new',compact('sales','books'));
    }
    public function store(Request $request){

        $validated_data = \Illuminate\Support\Facades\Validator::make($request->all(),[
            'sale_title'=>['required','string','max:256'],
            'sale_date'=>['required'],
            'attachment' => 'max:190000|mimes:jpeg,jpg,pdf,png,word,xlsx,cvs'
        ]);

        if ($validated_data->fails()) {
            return back()->with('fail','درج نام و تاریخ اجباری است|فرمت پیوست درست نیست ');
        }

        $deliver = OtherSales::create([
            'sale_title'=>$request['sale_title'],
            'sale_date'=>toGeorgianDate($request['sale_date']),
            'attachment'=>uploadFile($request->file('attachment'))
        ]);

        if (!is_null($request->book) && !is_null($request->count)){

            $books = $request->book;
            $counts = $request->count;
            $minusStock = $request->minus_stock;
            $totalAmount = $request->total_amount;
            for ($i=0;$i<count($books);$i++){
                $deliver->books()->attach([$books[$i] => ['count'=>$counts[$i],'minus_stock'=>$minusStock[$i],'total_amount'=>$totalAmount[$i]]]);
                if ($minusStock[$i] == true)
                    $this->updateStock($books[$i],$counts[$i]);
            }

        }

        return redirect(route('admin.other-sale.index'))->with('success','فروش کتاب با موفقیت ثبت شد');
    }



    public function destroy(OtherSales $sale,Request $request){
        $sale->books()->detach();
        $sale->deleteOrFail();
        return redirect(route('admin.other-sale.index'))->with('success','فروش کتاب با موفقیت حذف شد');
    }

    private function updateStock($book_id, $count)
    {
        $book = Book::find($book_id);
        if ($book->count >= $count) {
            $book->count = $book->count - abs($count);
            $book->save();
        }else{
            return back()->with('fail',"تعداد کتاب فروش رفته بیش از موجودی است.موجودی انبار بروز نشد");
        }


    }
}
