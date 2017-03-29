<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //create relationshp to User model
    public function users(){
        //specify the many to many join table 'role_users' at here
        return $this->belongsToMany('App\User', 'role_users', 'role_id', 'user_id');
    }
}
