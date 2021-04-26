<?php

namespace App\Models;

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



}
