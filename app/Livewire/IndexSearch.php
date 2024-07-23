<?php

namespace App\Livewire;

use App\Models\Book;
use App\Models\Category;
use Livewire\Component;
use function PHPUnit\Framework\isNull;

class IndexSearch extends Component
{

    public $title;
    public $category;

    public function search(){

        $this->redirectRoute('books.index',['title' => $this->title],navigate:true);

//        return view('livewire.books',['title' => $this->title]);
    }
    public function render()
    {

        $books = Book::where('count','>','0')->orderBy('id', 'desc')->paginate(50);

        if (!is_null($this->category)){
            $books = $this->category->books()->get();
        }

        return view('livewire.index-search',compact('books'));
    }

    public function searchCategory(Category $category){

        $this->category = $category;

    }
}
