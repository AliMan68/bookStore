<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:manage-news')->except(['show','allNews']);
    }

    public function index(){
        $news = News::all();
        return view('admin.news.manage',compact('news'));
    }

    public function store(Request $request){
        $validated_data = \Illuminate\Support\Facades\Validator::make($request->all(),[
            'title'=>'required|string|max:256',
            'image' => 'required|max:190000|mimes:jpeg,jpg,pdf,png',
            'attachment' => 'max:190000|mimes:jpeg,jpg,pdf,png,word,xlsx,cvs,zip,rar',
            'description'=>'required|string',
        ]);

        if ($validated_data->fails()) {
            return back()->with('fail',$validated_data->errors());
        }

        try {
            $news = News::create([
                'title'=>$request->title,
                'image'=>uploadFile($request->file('image')),
                'attachment'=>uploadFile($request->file('attachment')),
                'description'=>$request->description,
            ]);
            return back()->with('success','خبر با موفقیت ثبت شد');

        } catch (\Exception $e) {
            return back()->with('fail',$e->getMessage());
        }

    }
    public function update(Request $request, News $news)
    {
        $validated_data = \Illuminate\Support\Facades\Validator::make($request->all(),[
            'title'=>'required|string|max:256',
            'image' => 'max:190000|mimes:jpeg,jpg,pdf,png',
            'attachment' => 'max:190000|mimes:jpeg,jpg,pdf,png,word,xlsx,cvs,zip,rar',
            'description'=>'required|string',
        ]);
        if ($validated_data->fails()) {
            return back()->with('fail',$validated_data->errors());
        }
        try {

            $news->update([
                'title'=>$request->title,
                'image'=>((is_null($request->image)) ? $news->image : uploadFile($request->file('image'))),
                'attachment'=>(is_null($request->attachment) ? $news->image : uploadFile($request->file('attachment'))),
                'description'=>$request->description,
            ]);
            return back()->with('success','خبر با موفقیت ویرایش شد');
        }catch (\Exception $e){
            return back('fail',$e->getMessage());
        }
    }

    public function destroy(News $news){
        try {
            $news->delete();
            return redirect(route('admin.news.index'))->with('success','خبر با موفقیت حذف شد');
        }catch (\Exception $e){
            return back('fail',$e->getMessage());
        }
    }

    public function show(News $news){
        $latestNews = News::latest()->take(10)->get();
        return view('site.news-details',compact('news','latestNews'));
    }

    public function allNews(){
        $news = News::all();
        return view('site.news',compact('news'));
    }
}
