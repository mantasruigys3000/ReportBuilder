<?php

namespace App\Http\Livewire;

use Livewire\Component;

class DashboardPage extends Component
{
    public $tab = "all time";

    public $quotesBySmokers = "all time";


    public function mount(){
    }
    public function render()
    {
        return view('livewire.dashboard-page');
    }
}
