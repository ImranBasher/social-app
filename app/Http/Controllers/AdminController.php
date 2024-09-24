<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Trait\AuthinticatesUsers;

class AdminController extends Controller
{


    use AuthinticatesUsers;

    public function __construct()
    {
        // $this->checkAdmin(); 
        
    }


    public function index()
    {
        if(isUser()){

            return redirect("website.post.index");
        }

        return view('admin.layouts.admin');
    }

}
