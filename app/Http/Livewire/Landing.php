<?php

namespace App\Http\Livewire;

use App\Charts\TestChart;
use App\Models\Client;
use App\Models\Quote;
use Carbon\Carbon;
use Livewire\Component;

class Landing extends Component
{

    public $chart;

    public function mount()
    {






    }

    public function render()
    {
        $clients = Client::paginate(788);
        return view('livewire.landing',[
            'chart' => $this->chart,
        ])->layout('layouts.app');
    }
}
