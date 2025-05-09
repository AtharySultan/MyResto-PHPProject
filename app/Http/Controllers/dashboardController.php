<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class dashboardController extends Controller

{
    public function IndexDashboardController(){

        return view('admin.dashboard');

    }

    public function showMenueFunction(){

        return view('admin.showMenu');
  
       }

       public function ManageBookFunction(){

        return view('admin.ManageBook');
  
       }

      












}
