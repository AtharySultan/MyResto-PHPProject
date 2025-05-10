<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\TableReservation;
use Carbon\Carbon;

class dashboardController extends Controller
{
    public function IndexDashboardController()
    {
        // بيانات الطلبات
        $todayOrders = Order::whereDate('created_at', today())->count();
        $yesterdayOrders = Order::whereDate('created_at', today()->subDay())->count();
        $ordersChange = $yesterdayOrders > 0 ? (($todayOrders - $yesterdayOrders) / $yesterdayOrders * 100) : 0;
        $todayRevenue = Order::whereDate('created_at', today())->where('status', 'completed')->sum('total_price');
        $pendingOrders = Order::whereIn('status', ['pending', 'preparing'])->count();
        $pendingOrdersCount = Order::where('status', 'pending')->count();
        $completedOrdersCount = Order::where('status', 'completed')->count();
        $cancelledOrdersCount = Order::where('status', 'cancelled')->count();

        // بيانات الحجوزات
        $todayBookings = TableReservation::whereDate('reservation_date', today())->count();
        $pendingBookings = TableReservation::where('status', 'pending')->count();
        $urgentBookings = TableReservation::where('reservation_date', today())
            ->where('reservation_time', '>=', now())
            ->where('reservation_time', '<=', now()->addHours(2))
            ->where('status', 'confirmed')
            ->count();

        // جدول موحد لآخر الطلبات والحجوزات
        $recentOrders = Order::orderBy('created_at', 'desc')->take(5)->get()->map(function ($order) {
            return [
                'id' => $order->id,
                'type' => 'طلب',
                'name' => $order->customer_name,
                'date' => $order->created_at,
                'status' => $order->status
            ];
        });
        $recentReservations = TableReservation::orderBy('reservation_date', 'desc')->take(5)->get()->map(function ($reservation) {
            return [
                'id' => $reservation->id,
                'type' => 'حجز',
                'name' => $reservation->customer_name,
                'date' => $reservation->reservation_date . ' ' . $reservation->reservation_time,
                'status' => $reservation->status
            ];
        });
        $recentItems = $recentOrders->merge($recentReservations)->sortByDesc('date')->take(5);

        return view('admin.dashboard', compact(
            'todayOrders', 'ordersChange', 'todayRevenue', 'pendingOrders',
            'pendingOrdersCount', 'completedOrdersCount', 'cancelledOrdersCount',
            'todayBookings', 'pendingBookings', 'urgentBookings', 'recentItems'
        ));
    }
}