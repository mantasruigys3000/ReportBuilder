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

        $date = Carbon::createFromFormat('d/m/Y H:i','23/09/2020 00:00');
        DB::enableQueryLog();

        $quotes = Quote::select('id','client_one')->whereHas('client_1',function($query){
            $query->where('smoker',false);
        })->get();


        dd($quotes->count());
        //dd($quotes->count());

        $clients = collect();

//        $arr = [];
//        $clients= DB::table('clients')->select('id')->orderBy('id')->chunk(100,function ($c){
//            foreach ($c as $client){
//                $arr[$client->id] = $client->id;
//            }
//
//        });
//        dd($arr);


        //$clients = collect($clients );

        dd($clients);

//        $smoker_quotes = $quotes->with('client_1',function ($q){
//            $q->where('smoker','=','0');
//        })->get();


        //$non_smoker_quotes = $quotes

        dd($quotes->first());

        //dd($smoker_quotes->first()->client_1);




        //dd($quotes);

        foreach ($quotes as $quote){
            //dd($quote->client_1->smoker);
            if($quote->client_1->smoker){
                $smoker_quotes->add($quote);
            }else{
                $non_smoker_quotes->add($quote);
            }
        }



        return Chartisan::build()
            ->labels(['First', 'Second', 'Third'])
            ->dataset('Sample', [1, 2, 3])
            ->dataset('Sample 2', [3, 2, 1]);
    }
}