<?php

namespace App\Livewire;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Translator;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;

#[Layout('site.layout.app')]
#[Title('همه کتاب‌ها')]
class Books extends Component
{

    #[Url]
    public $title;
    public $pricing = 'ارزانترین';
    #[Url]
    public $categories = [];
    public $authors = [];
    public $translators = [];

    public function render()
    {
        $categories_id = (is_null($this->categories))? [] : $this->categories;
        $translators_id = (is_null($this->translators))? [] : $this->translators;
        $authors_id = (is_null($this->authors))? [] : $this->authors;
        $title = $this->title;
        $pricing = $this->pricing;

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


        return view('livewire.books',compact('books','categories_id','translators_id','authors_id','title','pricing'));
    }

    public function search(){


    }
}
