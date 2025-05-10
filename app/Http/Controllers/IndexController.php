<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dish;
use App\Models\Category;
use App\Models\OrderItem;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class IndexController extends Controller
{
    public function showIndex()
{
    $dishes = Dish::with('category')->get();
    $categories = Category::all();
    return view('Customer.index', compact('dishes', 'categories'));
}
}
