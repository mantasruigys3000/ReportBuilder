<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ChartsPage extends Component
{

    public function click($url){
        return redirect($url);
    }
    public function render()
    {
        return view('livewire.charts-page');
    }
}
