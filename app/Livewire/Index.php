<?php

namespace App\Livewire;

use App\Models\Book;
use App\Models\Category;
use App\Models\News;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
#[Layout('site.layout.app')]
#[Title('صفحه نخست')]

class Index extends Component
{

//    public $categories;
//    public $books;

    public function render()
    {
        $slider_items = News::latest()->take(5)->get();


//        $categories = Category::all();

        return view('livewire.index',compact("slider_items"));
    }


}
