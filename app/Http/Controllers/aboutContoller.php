<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class aboutContoller extends Controller
{
    
    public function about(){

        return view("Customer.about");
    }
    

}
