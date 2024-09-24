<?php

namespace App\Http\Controllers\WebsiteController;

use App\Trait\AuthinticatesUsers;
use App\Http\Controllers\Controller;

class WebController extends Controller
{

  use AuthinticatesUsers;

  public function __construct()
  {
      $this->checkAuthintication();    
  }


    public function websiteLogin(){

      return view("website.login");
    }

    // public function index(){
      
      
    //   return  view('website.index');
    // }
}
