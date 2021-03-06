<?php

declare(strict_types = 1);

namespace App\Charts;

use App\Models\Quote;
use Carbon\Carbon;
use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AgeOverTimeChart extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $fromParam = $request->get('from');
        $from = null;

        $toParam = $request->get('to');
        $to = null;

        $fromDate = null;
        $toDate = null;


        if($fromParam === null){
            $from = Carbon::createFromFormat('d-m-Y','01-01-2015');

        }else{
            $from =  Carbon::createFromFormat('Y-m-d',$fromParam);
        }

        if($toParam === null){
            $to = Carbon::createFromFormat('d-m-Y','26-04-2021');
        }else{
            $to =  Carbon::createFromFormat('Y-m-d',$toParam);
        }

        $fromDate = $from->toDateTimeString();
        $toDate = $to->toDateString();

        $quotes = DB::select(DB::raw("SELECT q.client_one,q.created_at,q.protection_subtype, c.id, c.dob, TIMESTAMPDIFF(year, c.dob, q.created_at) AS 'diff'
        FROM quotes q, clients c where q.client_one = c.id and q.created_at between '". $fromDate . "' AND '" . $toDate . "'"));

        //$quotes = Quote::hydrate($quotes);

        if($from->diffInYears($to) >= 1){
            $quotes = array_group_by($quotes,function($q){

                return Carbon::createFromFormat('Y-m-d H:i:s',$q->created_at)->englishMonth . '/'.  Carbon::createFromFormat('Y-m-d H:i:s',$q->created_at)->year;
            },function ($q){
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
            });
        }else{
            $quotes = array_group_by($quotes,function($q){

                return Carbon::createFromFormat('Y-m-d H:i:s',$q->created_at)->day . '/'.  Carbon::createFromFormat('Y-m-d H:i:s',$q->created_at)->englishMonth;
            },function ($q){
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
            });
        }




//        if($request->q == "last month"){
//           $quotes = $quotes->where('created_at','>=',Carbon::now()->subMonth());
//
//            $quotes = $quotes->groupby([function($q){
//                return $q->created_at->day . '/'.  $q->created_at->englishMonth;
//            },function ($q){
//                $age = $q->diff;
//
//                if($age < 18){
//                    return '-17';
//                }else if ($age >= 18 && $age <=25){
//                    return '18-25';
//                }else if ($age >= 26 && $age <=35){
//                    return '26-35';
//                }else if ($age >= 36 && $age <=45){
//                    return '36-45';
//                }else if ($age >= 46 && $age <=55){
//                    return '46-55';
//                }else if ($age >= 56){
//                    return '56+';
//                }
//            }]);
//
//        }else{
//            $quotes = $quotes->groupby([function($q){
//                return $q->created_at->englishMonth . '/'.  $q->created_at->year;
//            },function ($q){
//                $age = $q->diff;
//
//                if($age < 18){
//                    return '-17';
//                }else if ($age >= 18 && $age <=25){
//                    return '18-25';
//                }else if ($age >= 26 && $age <=35){
//                    return '26-35';
//                }else if ($age >= 36 && $age <=45){
//                    return '36-45';
//                }else if ($age >= 46 && $age <=55){
//                    return '46-55';
//                }else if ($age >= 56){
//                    return '56+';
//                }
//            }]);
//        }


        $counts = [];

        foreach ($quotes as $key => $quotegroup){
            foreach ($quotegroup as $keys2 => $list){
                $counts[$key][$keys2] = count($list);

            }
        }

        $datasets = [
            "36-45" => [],
            "46-55" => [],
            "26-35" => [],
            "56+" =>[],
            "18-25" => [],
            '-17' => []
        ];

        foreach ($datasets as $key => $arr){

            foreach ($counts as $key2=> $subarray){
                if(isset($subarray[$key])){
                    array_push($datasets[$key],$subarray[$key]);
                }else{
                    array_push($datasets[$key],0);

                }

            }
        }

        //dd($datasets);

        return Chartisan::build()
            ->labels(array_keys($quotes))
            ->dataset('-18', array_values($datasets['-17']))
            ->dataset('18-25', array_values($datasets['18-25']))
            ->dataset('26-35', array_values($datasets['26-35']))
            ->dataset('36-45', array_values($datasets['36-45']))
            ->dataset('46-55', array_values($datasets['46-55']))
            ->dataset('56+', array_values($datasets['56+']));
    }
}