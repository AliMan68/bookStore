<?php

namespace App\Livewire;

use Livewire\Component;

class Slider extends Component
{
    public $news;


    public function mount($news)
    {
        $this->news = $news;
    }
    public function render()
    {
        return view('livewire.slider');
    }


}
