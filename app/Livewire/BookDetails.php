<?php

namespace App\Livewire;

use App\Helpers\Cart\Cart;
use App\Models\Book;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Jantinnerezo\LivewireAlert\LivewireAlert;

#[Layout('site.layout.app')]
//#[Title($this->book->title.'جزییات کتاب')]
class BookDetails extends Component
{
    public  $book;
    public  $title;
    use LivewireAlert;


    public function mount(Book $book){
//        dd($book->title);
        $this->book = $book;
        $this->title = $book->title;
    }
    public function render()
    {
        return view('livewire.book-details',
        [
            "book"=>$this->book
        ])->title("جزییات کتاب $this->title" );
    }

    public function addToCard(Book $book){

        if(!Cart::has($book)){
            Cart::put([
                'id'=>'1',
                'quantity'=>1,
                'price'=>$book->price
            ],$book) ;

//            return back()->with('success','کتاب با موفقیت به سبد خرید اضافه شد');
            $cartCount = count(\App\Helpers\Cart\Cart::all());

            $this->dispatch('cartUpdated', $cartCount);
            $this->alert('success', 'کتاب با موفقیت به سبد خرید اضافه شد',[
                'position' => 'center',
                'timer' => 4000,
                'toast' => false,
                'timerProgressBar' => false,
            ]);
        }else
            $this->alert('warning', 'کتاب در سبد خرید موجود است',[
                'position' => 'center',
                'timer' => 4000,
                'toast' => false,
                'timerProgressBar' => true,
            ]);
//        return back()->with('fail','کتاب در سبد خرید موجود است');
    }
}
