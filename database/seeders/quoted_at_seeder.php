<?php

namespace Database\Seeders;

use App\Models\Quote;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class quoted_at_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


//        $q = Quote::skip(10)->first();
//        $q->quoted_at = Carbon::createFromFormat('d/m/Y H:i','15/02/2016 10:21');
//        $q->save();
//        dd('succ');

        //DB::statement("UPDATE quotes SET quoted_at =" .contents.type ."where favorite_contents.content_id = contents.id");

//        Quote::all()->update(['quoted_at' => Carbon::createFromFormat('d/m/Y H:i','created_at_old')]);

        Quote::chunk(300,function ($quotes){
            foreach ( $quotes as $quote) {
                if($quote->created_at_old != null){
                    //dd(Carbon::createFromFormat('d/m/Y H:i','15/02/2016 09:28'));
                    $quote->quoted_at = Carbon::createFromFormat('d/m/Y H:i',$quote->created_at_old); ;
                    //var_dump(Carbon::createFromFormat('d/m/Y H:i',$quote->created_at_old)->toDateTimeString(),$index);
                    //var_dump($quote->id);
                    $quote->save();
                }

            }
        });

        dd('done');


    }
}
