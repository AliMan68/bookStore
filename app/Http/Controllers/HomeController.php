<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\News;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){


        $books = Book::where('count','>','0')->orderBy('id', 'desc')->paginate(50);
        $news = News::latest()->take(5)->get();

        $categories = Category::all();
        return view('site.index',compact('books','categories','news'));
    }
}
