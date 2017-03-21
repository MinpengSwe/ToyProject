<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Sentinel knows where to find the full path, cause of config/app.php
use Sentinel;
use Activation;
use App\User;
use Mail;
use Illuminate\Database\QueryException;

class RegistrationController extends Controller
{
    //
    public function register()
    {
        return view('authentication.register');
    }

    public function postRegister(Request $request)
    {
        //dd($request);
        //$user = Sentinel::registerAndActivate($request->all());
        try{
            $user = Sentinel::register($request->all());
            $activation = Activation::create($user);
// dd($activation);
            $role = Sentinel::findRoleBySlug('manager');
            //relationship and method
            $role->users()->attach($user);
            $this->sendEmail($user, $activation->code);
            return redirect('/');
        }
        catch (QueryException $e)
        {
            return redirect()->back()->with(['error' => "Your email is registered already."]);
        }

        //dd($user);
    }

    public function sendEmail($user, $code)
    {
        //send function takes view, array of parameters feed to the view and closure function
        Mail::send('emails.activation', [
            'user' => $user,
            'code' => $code
        ], function($message) use ($user){
            $message->to($user->email);
            $message->subject("Hello $user->first_name, activate your account.");
        });
    }
}
