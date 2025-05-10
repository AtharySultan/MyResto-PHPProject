<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dish;
use App\Models\Category;
use App\Models\OrderItem;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
        return view('customer.profile', compact('orders'));
    }

    public function showOrder($id)
    {
        $order = Order::with('orderItems.dish')->where('user_id', Auth::id())->findOrFail($id);
        return view('customer.order-details', compact('order'));
    }

    public function storeOrder(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string',
            'customer_email' => 'required|email',
            'pickup_time' => 'required|date',
            'total_price' => 'required|numeric',
            'items' => 'required|array',
            'items.*.dish_id' => 'required|exists:dishes,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_price' => 'required|numeric',
        ]);

        $order = Order::create([
            'user_id' => Auth::id(),
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'pickup_time' => $request->pickup_time,
            'status' => 'pending',
            'total_price' => $request->total_price,
        ]);

        foreach ($request->items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'dish_id' => $item['dish_id'],
                'quantity' => $item['quantity'],
                'unit_price' => $item['unit_price'],
            ]);
        }

        return redirect()->route('order.show', $order->id)->with('status', 'تم تأكيد الطلب بنجاح!');
    }

    public function edit()
    {
        $user = Auth::user();
        return view('customer.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $user->update([
            'name' => $request->name,
        ]);

        return redirect()->route('customer.profile')->with('status', 'تم تحديث الملف الشخصي بنجاح!');
    }
}