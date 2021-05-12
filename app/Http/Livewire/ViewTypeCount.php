<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ViewTypeCount extends Component
{
    public $from = "";

    public $to = "";

    public $key = 0;

    public function addkey(){
        //$this->key++;
    }

    public function render()
    {
        return view('livewire.view-type-count');
    }
}
