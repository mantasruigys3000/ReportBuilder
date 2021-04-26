<?php

namespace App\Console\Commands;

use App\Models\Quote;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ConvertDates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dateconvert';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $quotes = Quote::all();
        foreach ($quotes as $quote){
            $date = Carbon::createFromFormat('d/m/Y H:i',$quote->created_at);
            $quote->created_at = $date;
            $quote->save();
        }
        return 0;
    }
}
