<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    public function getIndex(){
        return view('welcome');
    }

    public function getAbout(){
        $companyName="Code executable Inc";
        $isUserRegistered=false;
        $users=array("Renato", "Erik", "John");
        //this is the way to pass variable value to the view
        return view('pages/about')
            ->with("name", $companyName)
            ->with("isUserRegistered",$isUserRegistered)
            ->with("users", $users);
    }

    public function getContact(){
        return view('pages/contact');
    }

    public function getHelp(){
        return view('pages/help');
    }
}