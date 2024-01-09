<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
//        auth()->logout();
//        auth()->loginUsingId(3);
        $books = Book::where('count','>','0')->orderBy('id', 'desc')->paginate(50);
        $news = News::latest()->take(5)->get();

        $categories = Category::all();
        return view('site.index',compact('books','categories','news'));
    }
}
