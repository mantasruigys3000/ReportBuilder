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


}
