<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Deliver;
use App\Models\PublishmentRequest;
use Illuminate\Http\Request;

class DeliverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $delivers = Deliver::all();
        $books = Book::all();
        return view('admin.deliver-book.new',compact('delivers','books'));
    }

    public function store(Request $request){

        $validated_data = \Illuminate\Support\Facades\Validator::make($request->all(),[
            'transferee'=>['required','string','max:256'],
            'deliver_date'=>['required'],
            'attachment' => 'max:190000|mimes:jpeg,jpg,pdf,png,word'
        ]);

        if ($validated_data->fails()) {
            return back()->with('fail','درج نام و تاریخ اجباری است|فرمت پیوست درست نیست ');
        }

        $deliver = Deliver::create([
            'transferee'=>$request['transferee'],
            'deliver_date'=>toGeorgianDate($request['deliver_date']),
            'attachment'=>uploadFile($request->file('attachment'))
        ]);

        if (!is_null($request->book) && !is_null($request->count)){

            $books = $request->book;
            $counts = $request->count;
            $minusStock = $request->minus_stock;
            for ($i=0;$i<count($books);$i++){
                $deliver->books()->attach([$books[$i] => ['count'=>$counts[$i],'minus_stock'=>$minusStock[$i]]]);
                if ($minusStock[$i] == true)
                    $this->updateStock($books[$i],$counts[$i]);
            }

        }

        return redirect(route('admin.deliver-book.index'))->with('success','تحویل کتاب با موفقیت ثبت شد');
    }



    public function destroy(Deliver $deliver,Request $request){
        $deliver->books()->detach();
        $deliver->deleteOrFail();
        return redirect(route('admin.deliver-book.index'))->with('success','تحویل کتاب با موفقیت حذف شد');
    }

    private function updateStock($book_id, $count)
    {
        $book = Book::find($book_id);
        if ($book->count >= $count) {
            $book->count = $book->count - abs($count);
            $book->save();
        }else{
            return back()->with('fail',"تعداد کتاب تحویلی بیش از موجودی است.");
        }


    }
}
