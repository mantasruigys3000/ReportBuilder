<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory;

    protected $table = 'quotes';

    protected $dates = [
        'created_at'
    ];

    protected $dateFormat = 'd/m/Y H:i';




    public function client_1 () {
        return $this->belongsTo(Client::class,'client_one','id',);
    }


}
