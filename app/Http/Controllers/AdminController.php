<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;

class AdminController extends Controller
{
    //
    public function Index()
    {
        $users = User::all();
        return view('admins.admin')->with('users', $users);
    }

    public function postAdminAssignRoles(Request $request){
        $user = User::where('email', $request['email'])->first();
        $user->roles()->detach();
        if($request['role_user']){ //$request['role_user'] fetches value of the name of input name="role_user" in admin.blade.php
            $user->roles()->attach(Role::where('name','user')->first());
        }
        if($request['role_manager']){ //$request['role_user'] fetches value of the name of input name="role_manager" in admin.blade.php
            $user->roles()->attach(Role::where('name','manager')->first());
        }
        if($request['role_admin']){ //$request['role_user'] fetches value of the name of input name="role_admin" in admin.blade.php
            $user->roles()->attach(Role::where('name','admin')->first());
        }
        return redirect()->back();
    }
}
