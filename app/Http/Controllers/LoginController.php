<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentinel;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Session;

class LoginController extends Controller
{
    //
    public function login()
    {
        return view('authentication.login');
    }

    public function postLogin(Request $request)
    {
        //dd($request->all());
        try{
            if(Sentinel::authenticate($request->all()))
            {
                $slug=Sentinel::getUser()->roles()->first()->slug;

                if($slug == 'admin'){
                    //return redirect('/earnings');

                    if(Session::has('oldUrl')){
                        $oldUrl = Session::get('oldUrl');
                        Session::forget('oldUrl');
                        return redirect()->to($oldUrl);
                    }
                    return redirect('/product');
                }
                elseif($slug == 'manager'){
                    //return redirect('/tasks');
                    if(Session::has('oldUrl')){
                        $oldUrl = Session::get('oldUrl');
                        Session::forget('oldUrl');
                        return redirect()->to($oldUrl);
                    }
                    return redirect('/product');
                }
                else
                    return redirect('/product');
            }
            else{
                return redirect()->back()->with(['error' => 'Wrong credentials.']);
            }
        }
        catch (ThrottlingException $e)
        {
            $delay = $e->getDelay();
            return redirect()->back()->with(['error' => "You are banned for $delay seconds."]);
        }
        catch(NotActivatedException $e){
            return redirect()->back()->with(['error' => "Your account is not activated."]);
        }



    }

    public function logout()
    {
        Sentinel::logout();
        return redirect('/login');
    }
}
