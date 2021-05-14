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

        if($request->q =="all time"){
            $quotes = Quote::select('benefit','created_at')->cursor();
            $quotes = $quotes->groupBy(function($val){
                $createdAtCarbon = $val->created_at;
                return $createdAtCarbon->englishMonth . '/' . $createdAtCarbon->year;

            });
        }else if ($request->q == "last month"){
            $date = Carbon::now()->subMonth();
            $quotes = Quote::select('benefit','created_at')->where('created_at', '>=', $date)->cursor();

            $quotes = $quotes->groupBy(function($val){
                $createdAtCarbon = $val->created_at;
                return $createdAtCarbon->day . '/' . $createdAtCarbon->englishMonth;

            });


        }else{
            dd('q not set');
        }


        /*
         * 18-25 one
         * 26-35 two
         * 36-45 three
         * 46-55 four
         * 56+ five
         *
         */


        $avgs = [];
        $ages_one = [];
        $ages_two = [];
        $ages_three = [];
        $ages_four = [];
        $ages_five = [];


        foreach ($quotes->chunk(5) as $chunks){
            foreach ($chunks as $key => $quote){
                $avgs[$key] = $quote->avg('benefit');

            }
        }

//        $new_quotes = [];
//        foreach ($quotes->chunk(5) as $chunks){
//            foreach ($chunks as $key => $quote){
//
//
//                $maxes[$key] = $quote->max('benefit');
//
//            }
//        }



        return Chartisan::build()
            ->labels(array_keys($avgs))
            ->dataset('Average benefit quoted for', array_values($avgs));

    }
}