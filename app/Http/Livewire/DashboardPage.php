<?php

namespace App\Http\Livewire;

use App\Models\Quote;
use Carbon\Carbon;
use Livewire\Component;

class DashboardPage extends Component
{
    public $tab = "last month";

    public $quotesBySmokers = "all time";

    public $quotesThisMonth = 0;
    public $quotesDifference = 0;
    public $quotesLastMonth = 0;



    public function mount(){
        $date = Carbon::createFromFormat('Y-m-d','2021-03-26');
        $this->quotesThisMonth = Quote::where('created_at','>=',$date)->count();
        $quotesLastMonth = Quote::where('created_at','>=',$date->subMonth())->count();
        $this->quotesLastMonth = $quotesLastMonth;
        $diff = $this->quotesThisMonth - $quotesLastMonth;
        $this->quotesDifference = round(($diff/$this->quotesThisMonth) * 100,2);
    }
    public function render()
    {
        return view('livewire.dashboard-page');
    }
}
