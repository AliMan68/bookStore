<?php

namespace App\Http\Controllers\Site;

use App\Helpers\Cart\Cart;
use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Translator;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request){

        $categories_id = (is_null($request->categories))? [] : $request->categories;
        $translators_id = (is_null($request->translators))? [] : $request->translators;
        $authors_id = (is_null($request->authors))? [] : $request->authors;
        $title = $request->title;
        $pricing = $request->pricing;

        ($pricing == 'ارزانترین') ? $books = Book::orderBy('price','asc') : $books = Book::orderBy('price','desc') ;
//        $books = Book::orderBy('id','desc');
        (!is_null($title)) ? $books = $books->where('title','like',"%$title%"):'' ;

//        $books = $books->whereIn('id', $categories_id);

        if (count($categories_id) > 0){
            $books = $books->whereHas('categories', function ($q) use($categories_id) {
            $q->whereIn('id', $categories_id);
             });
        }
        if (count($translators_id) > 0){
            $books = $books->whereHas('translators', function ($q) use($translators_id) {
            $q->whereIn('id', $translators_id);
             });
        }

        if (count($authors_id) > 0){
            $books = $books->whereHas('authors', function ($q) use ($authors_id) {
                $q->whereIn('id', $authors_id);
            });
        }



        $books = $books->where('count','>','0')->get();

//        dd($books);
        $categories = Category::all();
        $authors = Author::all();
        $translators = Translator::all();
        return view('site.books',compact('books','categories','translators','authors','categories_id','translators_id','authors_id','title','pricing'));
    }

    public function bookItem(Book $book){
//        dd(Cart::all());
//         Cart::update($book,1);
//        session()->flush();
//        return session()->get('cart');
        return view('site.book-details',compact('book'));
    }
}
