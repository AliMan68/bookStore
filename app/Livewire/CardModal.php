<?php

namespace App\Livewire;

use App\Helpers\Cart\Cart;
use App\Models\Book;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\Attributes\On;


class CardModal extends Component
{

    use LivewireAlert;
    #[On('cartUpdated')]
    public function render()
    {
        return view('livewire.card-modal');
    }

//    public function removeBook($id){
////        dd($id);
//        if (Cart::delete($id)){
//            $this->alert('success', 'کتاب با موفقیت حذف شد',[
//                'position' => 'center',
//                'timer' => 2000,
//                'toast' => false,
//                'timerProgressBar' => false,
//            ]);
//            $cartCount = count(\App\Helpers\Cart\Cart::all());
//            $this->dispatch('cartUpdated', $cartCount);
//
//        }else{
//            return back()->with('fail','کتاب در سبد خرید موجود نیست');
//        }
//    }
}
