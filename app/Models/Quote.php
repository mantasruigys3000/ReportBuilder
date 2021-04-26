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


}
