@extends('layouts.admin')

@section('content')
<div class="container py-5" dir="rtl">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-header bg-warning text-white text-center py-3 rounded-top">
                    <h4 class="mb-0">{{ __('الطلبات المكتملة') }}</h4>
                </div>
                <div class="card-body p-4">
                    @if (session('status'))
                        <div class="alert alert-success text-end" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- جدول الطلبات المكتملة -->
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-warning">
                                <tr>
                                    <th>{{ __('رقم الطلب') }}</th>
                                    <th>{{ __('اسم العميل') }}</th>
                                    <th>{{ __('الإيميل') }}</th>
                                    <th>{{ __('وقت الاستلام') }}</th>
                                    <th>{{ __('السعر الإجمالي') }}</th>
                                    <th>{{ __('الحالة') }}</th>
                                    <th>{{ __('تاريخ الإكمال') }}</th>
                                    <th>{{ __('الأصناف') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($completedOrders as $order)
                                    <tr>
                                        <td>#{{ $order->id }}</td>
                                        <td>{{ $order->customer_name }}</td>
                                        <td>{{ $order->customer_email }}</td>
                                        <td>{{ \Carbon\Carbon::parse($order->pickup_time)->format('Y-m-d H:i') }}</td>
                                        <td>{{ number_format($order->total_price, 2) }} {{ __('ر.س') }}</td>
                                        <td>
                                            <span class="badge bg-success">
                                                {{ __('مكتمل') }}
                                            </span>
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($order->updated_at)->format('Y-m-d H:i') }}</td>
                                        <td>
                                            <button class="btn btn-warning btn-sm rounded-pill" type="button" data-bs-toggle="collapse" data-bs-target="#items-{{ $order->id }}" aria-expanded="false">
                                                {{ __('عرض الأصناف') }}
                                            </button>
                                            <div class="collapse mt-2" id="items-{{ $order->id }}">
                                                <ul class="list-group">
                                                    @foreach ($order->orderItems as $item)
                                                        <li class="list-group-item">
                                                            {{ $item->dish->name }} ({{ $item->quantity }} × {{ number_format($item->unit_price, 2) }} {{ __('ر.س') }})
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- التنقل بين الصفحات -->
                    <div class="mt-4">
                        {{ $completedOrders->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .container {
        text-align: right !important;
    }
    .card {
        background: #fff;
        border-radius: 15px;
        overflow: hidden;
    }
    .card-header {
        border-bottom: none;
    }
    .table-warning {
        background-color: #ffc107 !important;
        color: #fff !important;
    }
    .btn-warning:hover {
        background-color: #e0a800 !important;
        border-color: #d39e00 !important;
    }
    .table-hover tbody tr:hover {
        background-color: #f1f1f1 !important;
    }
    .alert-success {
        border-radius: 0.375rem !important;
    }
    .badge {
        font-size: 0.9rem !important;
    }
    .list-group-item {
        font-size: 0.9rem !important;
    }
    @media (max-width: 576px) {
        .table-responsive {
            font-size: 0.85rem !important;
        }
        .btn-sm {
            padding: 0.2rem 0.4rem !important;
            font-size: 0.75rem !important;
        }
        .badge {
            font-size: 0.8rem !important;
        }
    }
</style>
@endsection