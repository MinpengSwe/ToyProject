<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function byEmail($email)
    {
        return static::whereEmail($email)->first();
    }

    //one user can have many orders, relationship defined here
    public function orders(){
        return $this->hasMany('App\Order');
    }

    public function roles(){
        //specify the many to many join table 'role_users' at here
        return $this->belongsToMany('App\Role', 'role_users', 'user_id', 'role_id');
    }

    public function hasAnyRole($roles){
        if(is_array($roles)){//if $roles is an array of roles
            foreach($roles as $role){
                if($this->hasRole($role)){
                    return true;
                }
            }
        }
        else{
            if($this->hasRole($roles)){//if $roles is just a role, not an array of roles
                return true;
            }
        }
        return false;
    }

    public function hasRole($role){
        //the following call access the roles of a user and see where the use has the role = $role
        if($this->roles()->where('name', $role)->first()){
            return true;
        }
        else
            return false;
    }
}
