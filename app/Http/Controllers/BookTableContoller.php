<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookTableContoller extends Controller
{
    
    public function BookTable(){

        return view("Customer.BookTable");
    }

}
