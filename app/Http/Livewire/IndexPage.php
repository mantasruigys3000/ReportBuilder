<?php

namespace App\Http\Livewire;

use App\Models\Client;
use Livewire\Component;
use Livewire\WithPagination;

class IndexPage extends Component
{
    public $tab = "clients";


    public $quotes = [];

    use WithPagination;


    public function render()
    {


        return view('livewire.index-page',[
            'clients' => Client::paginate(100),
        ]);
    }
}
