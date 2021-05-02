<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Client extends Model
{
    use HasFactory;


    protected $table = 'clients';

    protected $primaryKey = 'id';

    protected $casts = [
        'smoker' => 'boolean',
    ];

    protected $dates = [
        'dob', 'created_at'
    ];


//    public function getQuotesAttribute(){
//        return $this->primaryQuotes->concat($this->secondaryQuotes);
//    }

//    public function quotes(){
//        return $this->hasMany(Quote::class,)
//    }

//    public function primaryQuotes(){
//        return $this->hasMany(Quote::class,'client_one','id');
//    }
//
//    public function secondaryQuotes(){
//        return $this->hasMany(Quote::class,'client_two','id');
//    }
//
//    public function getCreatedAtByQuoteAttribute(){
//        return $this->quotes->sortBy('quoted_at')->first()->quoted_at;
//    }


    public function ageAt(Carbon $date){
        return $date->diffInYears($this->dob);
    }

    public function getAgeAttribute(){
        return Carbon::now()->diffInYears($this->dob);
    }

    public function ageRange($age){

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
