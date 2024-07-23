<?php

namespace App\Livewire;


use App\Models\News;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithPagination;
#[Layout('site.layout.app')]
#[Title('اخبار و اطلاعیه‌ها')]
class AllNews extends Component
{
    use WithPagination;

    public function render()
    {
    //        sleep(2);
        $allNews = News::latest()->paginate(4);
        return view('livewire.all-news',compact('allNews'));
    }
    public function placeholder()
    {
        return view('livewire.includes.todo-card-placeholder');
    }
//    public function paginationView()
//
//    {
//
//        return 'vendor.livewire.bootstrap';
//
//    }
}
