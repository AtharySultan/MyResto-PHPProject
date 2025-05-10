<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // إضافة middleware للأدمن إذا كنتِ بتستخدمين أدوار
        // $this->middleware('role:admin');
    }

    public function index()
    {
        $orders = Order::with('orderItems.dish')
            ->whereNotIn('status', ['completed', 'cancelled']) // استبعاد المكتملة والملغاة
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('admin.ManageOrders', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with('orderItems.dish')->findOrFail($id);
        return view('admin.order-details', compact('order'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,preparing,ready,completed,cancelled',
        ]);

        $order = Order::findOrFail($id);
        $order->update([
            'status' => $request->status,
        ]);

        return redirect()->route('admin.orders.index')->with('status', 'تم تحديث حالة الطلب بنجاح!');
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->update([
            'status' => 'cancelled',
        ]);

        return redirect()->route('admin.orders.index')->with('status', 'تم إلغاء الطلب بنجاح!');
    }

    public function previous()
    {
        $cancelledOrders = Order::with('orderItems.dish')
            ->where('status', 'cancelled')
            ->orderBy('updated_at', 'desc')
            ->paginate(10);
        return view('admin.PreviousOrders', compact('cancelledOrders'));
    }

    public function completed()
    {
        $completedOrders = Order::with('orderItems.dish')
            ->where('status', 'completed')
            ->orderBy('updated_at', 'desc')
            ->paginate(10);
        return view('admin.CompletedOrders', compact('completedOrders'));
    }
}