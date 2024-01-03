<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function sendComment(Request $request){

        $validatedData = $request->validate([
            'commentable_type'=>['required'],
            'commentable_id'=>['required'],
            'comment'=>['required'],
            'parent_id'=>['required'],
        ]);

        auth()->user()->comments()->create($validatedData);
        return back()->with('success','نظر شما با موفقیت ثبت شد.پس از بررسی نمایش داده می‌شود');
    }

    public function pendingComments(){

        $comments = Comment::query()->where('approved','=',0)->paginate(20);


        return view('admin.comments.pending',compact('comments'));
    }
    public function confirmComments(Comment $comment){
        $comment->updateOrFail([
           'approved' => 1
        ]);
        return back()->with('success','نظر با موفقیت تایید شد');
    }
    public function rejectComments(Comment $comment){
        $comment->deleteOrFail();
        return back()->with('success','نظر با موفقیت حذف شد');
    }
    public function manageComments(Request $request){
        $comments = Comment::query();
        if ($parameter = $request->search)
            $comments->where('comment','like',"%$parameter%")->orWhereHas('user',function ($query) use($parameter){
                $query->where('name','like',"%$parameter%");
            })->orWhereHas('commentable',function ($query) use($parameter){
                $query->where('title','like',"%$parameter%");
            });


        $comments = $comments->paginate(20);
        return view('admin.comments.manage',compact('comments'));
    }
}
