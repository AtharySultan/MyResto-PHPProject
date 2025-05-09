<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dish;
use App\Models\Category;
use App\Models\OrderItem;
use App\Models\Order;

use Illuminate\Support\Facades\Storage;

class orderController extends Controller
{
    public function showOrder(){
        $dishes = Dish::with('category')->get();
        $categories = Category::all();
        
        return view('Customer.order', compact('dishes', 'categories'));
    }

    public function checkOut($orderId)
{
    $order = Order::with('orderItems.dish')->findOrFail($orderId);
    return view('customer.checkout', compact('order'));
}

    
    public function placeOrder(Request $request)
    {
        $data = json_decode($request->input('orderData'), true);
    
        $total = 0;
        foreach ($data as $item) {
            $total += $item['unit_price'] * $item['quantity'];
        }
    
        $order = Order::create([
            'customer_name' => 'اسم مؤقت', // تقدر تاخذه من form ثاني
            'customer_phone' => '0500000000',
            'pickup_time' => now()->addHour(),
            'status' => 'pending',
            'total_price' => $total,
        ]);
    
        foreach ($data as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'dish_id' => $item['id'],
                'quantity' => $item['quantity'],
                'unit_price' => $item['unit_price'],
            ]);
        }
    
        return redirect()->route('Customer.checkOut', ['orderId' => $order->id]);
    }
    
    
}
