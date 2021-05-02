<?php

declare(strict_types = 1);

namespace App\Charts;

use App\Models\Client;
use App\Models\Quote;
use Carbon\Carbon;
use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SmokerChart extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        //dd(Quote::whereHas('client_1')->with('client_1')->first());

        $date = Carbon::now()->subMonth();
        DB::enableQueryLog();

        if($request->q == "all time"){
            $non_smoker_quotes = Quote::select('id','client_one')->whereHas('client_1',function($query){
                $query->where('smoker',false);
            })->cursor();

            $smoker_quotes = Quote::select('id','client_one')->whereHas('client_1',function($query){
                $query->where('smoker',true);
            })->cursor();
        }
        else if ($request->q == "last month"){
            $non_smoker_quotes = Quote::select('id','client_one')->where('created_at', '>=' ,$date)->whereHas('client_1',function($query){
                $query->where('smoker',false);
            })->cursor();

            $smoker_quotes = Quote::select('id','client_one')->where('created_at', '>=' ,$date)->whereHas('client_1',function($query){
                $query->where('smoker',true);
            })->cursor();
        }




        $result = [
            'Smokers'=> $smoker_quotes->count(),
            'Non smokers' => $non_smoker_quotes->count()
        ];




        return Chartisan::build()
            ->labels(array_keys($result))
            ->dataset('dataset 1',array_values($result));
    }
}