<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
//        auth()->logout();
//        auth()->loginUsingId(3);
        $books = Book::where('count','>','0')->orderBy('id', 'desc')->paginate(50);
        $categories = Category::all();
        return view('site.index',compact('books','categories'));
    }
}
