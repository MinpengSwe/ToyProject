<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //one order belongs to one user, relationship defined here
    public function user(){
        return $this->belongsTo('App\User');
    }
}
