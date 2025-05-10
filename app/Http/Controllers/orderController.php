<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dish;
use App\Models\Category;
use App\Models\OrderItem;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class orderController extends Controller
{
    public function showOrder()
    {
        $dishes = Dish::with('category')->get();
        $categories = Category::all();
        
        return view('Customer.order', compact('dishes', 'categories'));
    }

    public function checkOut()
    {
        // صفحة التشيك أوت لا تحتاج إلى معرف طلب، لأن البيانات تأتي من localStorage
        return view('customer.checkout');
    }

    public function placeOrder(Request $request)
    {
        // تحقق من تسجيل الدخول
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'يجب تسجيل الدخول أولاً لمتابعة الطلب.');
        }

        $validated = $request->validate([
            'customer_name' => 'required|string',
            'customer_email' => 'required|email',
            'pickup_time' => 'required|date',
            'total_price' => 'required|numeric',
            'items' => 'required|json',
        ]);

        $items = json_decode($request->items, true);

        // إنشاء الطلب
        $order = Order::create([
            'user_id' => Auth::id(),
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'customer_phone' => '0500000000', // يمكنك تعديل هذا لأخذ الرقم من نموذج
            'pickup_time' => $request->pickup_time,
            'status' => 'pending',
            'total_price' => $request->total_price,
        ]);

        // إنشاء عناصر الطلب
        foreach ($items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'dish_id' => $item['dish_id'],
                'quantity' => $item['quantity'],
                'unit_price' => $item['unit_price'],
            ]);
        }

        return redirect()->route('order.show', $order->id)->with('status', 'تم تأكيد الطلب بنجاح!');
    }

    public function cancel(Order $order)
    {
        if (in_array($order->status, ['pending', 'preparing'])) {
            $order->status = 'cancelled';
            $order->save();
            return redirect()->back()->with('success', 'تم إلغاء الطلب بنجاح');
        }

        return redirect()->back()->with('error', 'لا يمكن إلغاء هذا الطلب');
    }
}