<?php

namespace App\Http\Livewire;

use App\Models\Client;
use App\Models\Quote;
use Carbon\Carbon;
use Livewire\Component;

class Landing extends Component
{


    public function mount()
    {


        $quotes = Quote::select('benefit','created_at')->get();

        $res= $quotes->groupBy(function($val) {
            return ($val->created_at->year . '/' . $val->created_at->month);
        });


        $groups = array_keys($res->toArray());
        $avgs = [];
        foreach ($groups as $group){
            $avgs[$group] = $res[$group]->avg('benefit');
        }



        dd($avgs);

    }

    public function render()
    {
        $clients = Client::paginate(788);
        return view('livewire.landing',compact('clients'))->layout('layouts.app');
    }
}
