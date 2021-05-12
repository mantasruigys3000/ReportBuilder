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
        $quotes = DB::select(DB::raw("SELECT q.client_one,q.created_at,q.protection_subtype, c.id, c.dob, TIMESTAMPDIFF(year, c.dob, q.created_at) AS 'diff'
        FROM quotes q, clients c where q.client_one = c.id"));

        $quotes = Quote::hydrate($quotes);

        if($request->q == "last month"){
           // $quotes = $quotes->where('created_at','>=',Carbon::now()->subMonth());

        }
        $quotes = $quotes->groupby([function($q){
            return $q->created_at->month . '/'.  $q->created_at->year;
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
        }]);

        $counts = [];

        foreach ($quotes as $key => $quotegroup){
            foreach ($quotegroup as $keys2 => $list){
                $counts[$key][$keys2] = $list->count();

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
            ->labels(array_keys($quotes->toArray()))
            ->dataset('-17', array_values($datasets['-17']))
            ->dataset('18-25', array_values($datasets['18-25']))
            ->dataset('26-35', array_values($datasets['26-35']))
            ->dataset('36-45', array_values($datasets['36-45']))
            ->dataset('46-55', array_values($datasets['46-55']))
            ->dataset('56+', array_values($datasets['56+']));
    }
}