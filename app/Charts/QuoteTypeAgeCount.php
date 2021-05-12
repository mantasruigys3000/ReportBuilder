<?php

declare(strict_types = 1);

namespace App\Charts;

use App\Models\Quote;
use Carbon\Carbon;
use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Collection;
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
        $counts = [];

        $quotes = DB::select(DB::raw("SELECT q.client_one,q.created_at,q.protection_subtype, c.id, c.dob, TIMESTAMPDIFF(year, c.dob, q.created_at) AS 'diff'
 FROM quotes q, clients c where q.client_one = c.id"));

        $quotes = Quote::hydrate($quotes);

        $quotes= $quotes->groupby(['protection_subtype',function ($q){
            $age = $q->diff;

            if($age < 18){
                return '-17';
            }else if ($age >= 18 && $age <=25){
                return '18-25';
            }else if ($age >= 26 && $age <=35){
                return '26-35';
            }else if ($age >= 36 && $age <=45){
                return '36-45';
            }else if ($age >= 46 && $age <=55){
                return '46-55';
            }else if ($age >= 56){
                return '56+';
            }
        }]);
        //dd($quotes);
//
//        $quotes = $quotes->groupBy(function ($q){
//            $age = $q->diff;
//
//            if($age < 18){
//                return '-17';
//            }else if ($age >= 18 && $age <=25){
//                return '18-25';
//            }else if ($age >= 26 && $age <=35){
//                return '26-35';
//            }else if ($age >= 36 && $age <=45){
//                return '36-45';
//            }else if ($age >= 46 && $age <=55){
//                return '46-55';
//            }else if ($age >= 56){
//                return '56+';
//            }
//        });
//

        foreach (array_keys($quotes->toArray()) as $key ) {
            $counts[$key] = [
                '-17' => $quotes[$key]['-17']? count($quotes[$key]['-17']): 0,
                '18-25' => $quotes[$key]['18-25']?count($quotes[$key]['18-25']): 0,
                '26-35' => $quotes[$key]['26-35']?count($quotes[$key]['26-35']): 0,
                '36-45' => $quotes[$key]['36-45']?count($quotes[$key]['36-45']): 0,
                '46-55' => $quotes[$key]['46-55']?count($quotes[$key]['46-55']): 0,
                '56+' => $quotes[$key]['56+']?count($quotes[$key]['56+']): 0
            ];
        }
//        $counts = [
//            '-17' => $quotes['-17']?$quotes['-17']->count(): 0,
//            '18-25' => $quotes['18-25']?$quotes['18-25']->count(): 0,
//            '26-35' => $quotes['26-35']?$quotes['26-35']->count(): 0,
//            '36-45' => $quotes['36-45']?$quotes['36-45']->count(): 0,
//            '46-55' => $quotes['46-55']?$quotes['46-55']->count(): 0,
//            '56+' => $quotes['56+']?$quotes['56+']->count(): 0
//        ];

        unset($quotes);
//        foreach ($quotes as $quote) {
//            $subtype = $quote->protection_subtype;
//            if (!key_exists($subtype,$counts)){
//                $counts[$subtype] = [];
//            }
//
//            $age = $age = $quote->client_1->ageAt($quote->created_at);
//            $ageRange = $quote->client_1->ageRange($age);
//
//            if (key_exists($ageRange,$counts[$subtype])){
//                $counts[$subtype][$ageRange]++;
//            }else{
//                $counts[$subtype][$ageRange] = 1;
//            }
//        }
//
//        dd('hello');
//
//
//
//
//        $groups = [];
//
//        foreach($quotes as $key => $quoteList){
////            /dd($quoteList);
//            $groups[$key] = $quoteList->groupBy('client_1.sex');
//        }
//
//
//        foreach ($chunk as $quote){
//            $subtype = $quote->protection_subtype;
//            if (!key_exists($subtype,$counts)){
//                $counts[$subtype] = [];
//            }
//
//            $age = $age = $quote->client_1->ageAt($quote->created_at);
//            $ageRange = $quote->client_1->ageRange($age);
//
//            if (key_exists($ageRange,$counts[$subtype])){
//                $counts[$subtype][$ageRange]++;
//            }else{
//                $counts[$subtype][$ageRange] = 1;
//            }
//        }
//
//        $quotes = $quotes->groupBy(function ($q){
//            return $q->protection_subtype;
//        });
//
//
//
//        $quotes->chunk(300,function($quotes){
//            dd($quotes);
//            foreach ($quotes as $key => $arr){
//                if(!key_exists($key,$counts)){
//                    $counts[$key] = [];
//                }
//                foreach ($arr as $quote){
//
//                    $age = $quote->client_1->ageAt($quote->created_at);
//                    $ageRange = $quote->client_1->ageRange($age);
//                    if(key_exists($ageRange,$counts[$key])){
//                        $counts[$key][$ageRange]++;
//                    }else{
//                        $counts[$key][$ageRange] = 0;
//
//                    }
//                }
//            }
//        });



        //dd($counts);

        //dd($counts);
        return Chartisan::build()
            ->labels(['-17', '18-25', '26-35', '36-45', '46-55', '56+'])
            ->advancedDataset('Level Term', array_values($counts["TERM"]),[])
            ->advancedDataset('Mortgage Protection', array_values($counts["MORTGAGEPROTECTION"]),[
                'hidden' => true,
            ])
            ->advancedDataset('Family Income benefit', array_values($counts["FAMILYINCOMEBENEFIT"]),[
                'hidden' => true,
            ]);
    }

}