<?php

namespace App\Http\Livewire;

use App\Models\Client;
use Livewire\Component;
use Livewire\WithPagination;

class IndexPage extends Component
{
    public $tab = "clients";

    public $currentClient = null;



    public $quotes = [];

    use WithPagination;

    public function setCurrentClient(Client $client){
        $this->currentClient = $client;

    }


    public function render()
    {


        return view('livewire.index-page',[
            'clients' => Client::where('smoker',true)->paginate(30),
        ]);
    }
}
