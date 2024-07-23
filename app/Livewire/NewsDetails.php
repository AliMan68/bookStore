<?php

namespace App\Livewire;

use App\Models\News;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
#[Layout('site.layout.app')]
#[Title('جزییات خبر')]
class NewsDetails extends Component
{
    public News $news;
    public function mount($news){

        $this->news = $news;
    }
    public function render()
    {
        $latestNews = News::latest()->take(10)->get();
        return view('livewire.news-details',[
            "news"=>$this->news,
            "latestNews"=>$latestNews,
        ]);
    }
}
