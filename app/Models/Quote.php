<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory;

    protected $table = 'quotes';

//    protected $casts = [
//        'created_at_old' => 'datetime:d/m/Y H:i',
//    ];
////
////
//    protected $dateFormat = 'd/m/Y H:i';

    protected $dates = [
      'quoted_at',
    ];

//    protected function serializeDate(DateTimeInterface $date)
//    {
//        return $date->format('d/m/Y H:i');
//    }


    public function client_1 () {
        return $this->belongsTo(Client::class,'client_one','id');
    }

    public function getClient1AgeQuotedAttribute(){
        if(isset($this->client_1->dob)){
            return $this->client_1->dob->diffInYears($this->created_at);
        }else{
            return 0;
        }
    }

    public function getClient1AgeRangeQuotedAttribute(){
        $age = $this->client1AgeQuoted;

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
    }



}
