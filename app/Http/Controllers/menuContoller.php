<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dish;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class menuContoller extends Controller
{

    public function menu(){

        return view("Customer.menu");
    }


    public function showMenu()
    {
        // جلب الأطباق مع الفئات
        $dishes = Dish::with('category')->get();
        
        // جلب جميع الفئات من قاعدة البيانات
        $categories = Category::all(); 
    
        return view('Customer.menu', compact('dishes', 'categories'));
    }
    





}
