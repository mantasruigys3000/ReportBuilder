<?php

declare(strict_types = 1);

namespace App\Charts;

use App\Models\Quote;
use Carbon\Carbon;
use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Catch_;

class QuoteTypeAgeCount extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {

        $date = Carbon::now()->subYears(2);


        $quotes =  Quote::select('protection_subtype','client_one','created_at')->where('created_at','>=',$date)->whereHas('client_1')->cursor()->groupBy(function($q){
            return $q->client1AgeRangeQuoted;
        });

        $counts = [];

        //$quotes = Quote::first();

        dd($quotes->all());




        $groups = [];

        foreach($quotes as $key => $quoteList){
//            /dd($quoteList);
            $groups[$key] = $quoteList->groupBy('client_1.sex');
        }


        foreach ($chunk as $quote){
            $subtype = $quote->protection_subtype;
            if (!key_exists($subtype,$counts)){
                $counts[$subtype] = [];
            }

            $age = $age = $quote->client_1->ageAt($quote->created_at);
            $ageRange = $quote->client_1->ageRange($age);

            if (key_exists($ageRange,$counts[$subtype])){
                $counts[$subtype][$ageRange]++;
            }else{
                $counts[$subtype][$ageRange] = 1;
            }
        }

        $quotes = $quotes->groupBy(function ($q){
            return $q->protection_subtype;
        });



        $quotes->chunk(300,function($quotes){
            dd($quotes);
            foreach ($quotes as $key => $arr){
                if(!key_exists($key,$counts)){
                    $counts[$key] = [];
                }
                foreach ($arr as $quote){

                    $age = $quote->client_1->ageAt($quote->created_at);
                    $ageRange = $quote->client_1->ageRange($age);
                    if(key_exists($ageRange,$counts[$key])){
                        $counts[$key][$ageRange]++;
                    }else{
                        $counts[$key][$ageRange] = 0;

                    }
                }
            }
        });



        dd($counts);


        return Chartisan::build()
            ->labels(['18-25', '26-35', '36-45', '46-55', '56+'])
            ->dataset('Level Term', [1, 2, 3])
            ->dataset('Motrgage Protection', [3, 2, 1])
            ->dataset('Family Income benefit', [3, 2, 1]);
    }

}