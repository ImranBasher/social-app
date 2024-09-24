<?php 

namespace App\Trait;

use Illuminate\Support\Facades\Auth;

trait AuthinticatesUsers
{
    public function checkAuthintication()

    {

        // dd(12345);
        if(!Auth::check()){  //  !Auth::check() returns true if the user is not authenticated and false if the user is authenticated.
                                // means “if the user is not authenticated, then execute the code inside the curly braces { }.”
       
          return redirect()->route('website.login')->with('error', 'You must be logged in to access this page.');
        }
    }


    public function checkAdmin(){
        if(!Auth::check() || !Auth::user()->isAdmin){
            redirect()->route('website.login')->with('error', 'You do not have the necessary permissions to access this page.');
        }
    }
}