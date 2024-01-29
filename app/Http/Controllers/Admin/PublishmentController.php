<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Book;
use App\Models\PublishmentRequest;
use Illuminate\Http\Request;

class PublishmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:manage-publish-request');

    }

    public function create(){
        $books = Book::all();
        return view('admin.publishment.new',compact('books'));
    }
    public function index(){
        $requests = PublishmentRequest::all();
        return view('admin.publishment.requests',compact('requests'));
    }

    public function store(Request $request){

        $data = $request->validate([
            'request_number'=>['required','string','max:256'],
            'request_date'=>['required'],
            'total_amount'=>['required','max:256'],
            'attachment' => 'mimes:jpeg,jpg,pdf,png'
        ]);

        $req = PublishmentRequest::create([
            'request_number'=>$data['request_number'],
            'attachment'=>uploadFile($request->file('attachment')),
            'request_date'=>toGeorgianDate($data['request_date']),
            'total_amount'=>$data['total_amount']

        ]);
        if (!is_null($request->book) && !is_null($request->count)){
            $books = $request->book;
            $counts = $request->count;
            for ($i=0;$i<count($books);$i++){
                $req->books()->attach([$books[$i] => ['count'=>$counts[$i]]]);
            }
        }
        return redirect(route('admin.publish-request.create'))->with('success','درخواست با موفقیت ثبت شد');
    }
    public function destroy(PublishmentRequest $publishmentRequest){
        $publishmentRequest->books()->detach();
        $publishmentRequest->deleteOrFail();
        return redirect(route('admin.publish-request.index'))->with('success','درخواست با موفقیت حذف شد');
    }
}
