<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ViewAgeOverTimeChart extends Component
{
    public $from = "";

    public $to = "";

    public $key = 0;

    public function render()
    {
        return view('livewire.view-age-over-time-chart');
    }
}
