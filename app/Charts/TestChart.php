<?php

declare(strict_types = 1);

namespace App\Charts;

use App\Models\Quote;
use Carbon\Carbon;
use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestChart extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        //$quotes = Quote::select('benefit','created_at')->get();
        //dd($quotes);

        $quotes = DB::select("SELECT quotes.benefit, quotes.created_at from QUOTES");
        $quotes = collect($quotes);
        //dd($quotes->first());

        $res= $quotes->groupBy(function($val) {
            return (Carbon::createFromFormat('d/m/Y H:i',$val->created_at)->year . '/' . Carbon::createFromFormat('d/m/Y H:i',$val->created_at)->month);
        });


        $groups = array_keys($res->toArray());
        $avgs = [];
        foreach ($groups as $group){
            $avgs[$group] = round($res[$group]->avg('benefit'));
        }

        //dd($avgs);



        return Chartisan::build()
            ->labels(array_keys($avgs))
            ->dataset('Averages', array_values($avgs));

    }
}