<?php

namespace App\Http\Livewire;

use App\Models\Client;
use Livewire\Component;
use Livewire\WithPagination;

class IndexPage extends Component
{
    public $tab = "clients";

    public $currentClient = null;

    public $orderby = 'latest';




    public $quotes = [];

    use WithPagination;

    public function setCurrentClient(Client $client){
        $this->currentClient = $client;

    }

    public function updatedOrderby(){
        //dd('updated');

    }


    public function render()
    {
        $order = 'ASC';
        $property = 'created_at';

        switch ($this->orderby){
            case 'oldest':
                $order = 'DESC';
                $property = 'created_at';
                break;
            case 'youngold':
                $order = 'ASC';
                $property = 'dob';
                break;
            case 'oldyoung':
                $order = 'DESC';
                $property = 'dob';
                break;

        }

        if($this->orderby == 'oldest'){
            $l='DESC';
        }

        return view('livewire.index-page',[



            'clients' => Client::where('smoker',true)->orderBy($property,$order)->paginate(30),
        ]);
    }
}
