<?php

namespace App\Http\Livewire;

use App\Models\Client;
use App\Models\Quote;
use Livewire\Component;

class Landing extends Component
{


    public function mount()
    {

    }

    public function render()
    {
        $clients = Client::paginate(788);
        return view('livewire.landing',compact('clients'))->layout('layouts.app');
    }
}
