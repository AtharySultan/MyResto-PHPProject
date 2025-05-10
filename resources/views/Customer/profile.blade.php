@extends('layouts.app')

@section('content')
<div class="profile-container py-5" dir="rtl">
    <div class="row ">
        <div class="col-md-10 col-lg-8 mx-auto">
            <!-- كارد المعلومات الشخصية -->
            <div class="card shadow-lg border-0 rounded-3 mb-4">
        <div class="card-header bg-warning text-white text-center py-3 rounded-top">
        <h4 class="mb-0">{{ __('المعلومات الشخصية') }}</h4>
    </div>
    <div class="card-body p-4">
        <div class="row align-items-center">
            <div class="col-md-4 text-center">
                <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="User Icon" width="120" class="rounded-circle mb-3">
                <h4 class="card-title">{{ Auth::user()->name }}</h4>
            </div>
            <div class="col-md-8 d-flex flex-column justify-content-between" style="height: 100%;">
                <div class="row text-end">
                    <div class="col-md-6 mb-3">
                        <p class="card-text"><i class="bi bi-envelope-fill ms-2"></i><strong>{{ __('البريد الإلكتروني') }}:</strong> {{ Auth::user()->email }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="card-text"><i class="bi bi-calendar-fill ms-2"></i><strong>{{ __('تاريخ التسجيل') }}:</strong> {{ Auth::user()->created_at->format('Y-m-d') }}</p>
                    </div>
                    @if (Auth::user()->phone)
                        <div class="col-md-6 mb-3">
                            <p class="card-text"><i class="bi bi-phone-fill ms-2"></i><strong>{{ __('رقم الهاتف') }}:</strong> {{ Auth::user()->phone }}</p>
                        </div>
                    @endif
                </div>

                <!-- أزرار التحرير والخروج بأسفل الكارد جهة اليسار -->
                <div class="d-flex justify-content-start mt-4">
                    <a href="{{ route('customer.edit') }}" class="btn btn-warning rounded-pill py-2 me-2">{{ __('تحرير الملف الشخصي') }}</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-danger rounded-pill py-2">{{ __('تسجيل الخروج') }}</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>


            <!-- كارد الطلبات -->
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-header bg-warning text-white text-center py-3 rounded-top">
                    <h4 class="mb-0">{{ __('الطلبات') }}</h4>
                </div>
                <div class="card-body p-4">
                    <!-- تبويبات الطلبات -->
                    <ul class="nav nav-tabs mb-3" id="ordersTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="current-orders-tab" data-bs-toggle="tab" data-bs-target="#current-orders" type="button" role="tab" aria-controls="current-orders" aria-selected="true">{{ __('الطلبات الحالية') }}</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="past-orders-tab" data-bs-toggle="tab" data-bs-target="#past-orders" type="button" role="tab" aria-controls="past-orders" aria-selected="false">{{ __('الطلبات السابقة') }}</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="ordersTabContent">

                        <!-- الطلبات الحالية -->
                        <div class="tab-pane fade show active" id="current-orders" role="tabpanel" aria-labelledby="current-orders-tab">
                            
                           @if ($orders->whereIn('status', ['pending', 'preparing', 'ready'])->isEmpty())
                                <p class="text-center text-muted">{{ __('لا توجد طلبات حالية') }}</p>
                            @else
                            <ul class="list-group text-end">
                            @foreach ($orders->whereIn('status', ['pending', 'preparing', 'ready']) as $order)
                             <li class="list-group-item d-flex justify-content-between align-items-center">
                                 <div>
                                 <strong>{{ __('طلب رقم') }} #{{ $order->id }}</strong> - {{ $order->created_at->format('Y-m-d') }}
                                <br>
                                <small>{{ __('الحالة') }}:
                                    @switch($order->status)
                                    @case('pending') {{ __('معلق') }} @break
                                    @case('preparing') {{ __('قيد التحضير') }} @break
                                    @case('ready') {{ __('جاهز') }} @break
                                    @endswitch
                                </small>
                        </div>
                    <div>
                <a href="{{ route('order.show', $order->id) }}" class="btn btn-warning btn-sm rounded-pill me-2">{{ __('عرض التفاصيل') }}</a>
                <form action="{{ route('order.cancel', $order->id) }}" method="POST" class="d-inline">
                 @csrf
                    <button type="submit" class="btn btn-danger btn-sm rounded-pill" onclick="return confirm('هل أنت متأكد من إلغاء الطلب؟')">
                        {{ __('إلغاء الطلب') }}
                    </button>
                </form>
            </div>
                            </li>
                            @endforeach
                        </ul>

                            @endif
                        </div>
                        <!-- الطلبات السابقة -->
                        <div class="tab-pane fade" id="past-orders" role="tabpanel" aria-labelledby="past-orders-tab">
                            @if ($orders->whereIn('status', ['completed', 'cancelled'])->isEmpty())
                                <p class="text-center text-muted">{{ __('لا توجد طلبات سابقة') }}</p>
                            @else
                                <ul class="list-group text-end">
                                    @foreach ($orders->whereIn('status', ['completed', 'cancelled']) as $order)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <div>
                                                <strong>{{ __('طلب رقم') }} #{{ $order->id }}</strong> - {{ $order->created_at->format('Y-m-d') }}
                                                <br>
                                                <small>{{ __('الحالة') }}: 
                                                    @switch($order->status)
                                                        @case('completed') {{ __('مكتمل') }} @break
                                                        @case('cancelled') {{ __('ملغي') }} @break
                                                    @endswitch
                                                </small>
                                            </div>
                                            <a href="{{ route('order.show', $order->id) }}" class="btn btn-warning btn-sm rounded-pill">{{ __('عرض التفاصيل') }}</a>                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .profile-container {
        text-align: right !important;
        padding: 3rem 1rem;
    }
    .profile-container .row {
        justify-content: center !important;
    }
    .card {
        background: #fff;
        border-radius: 15px;
        overflow: hidden;
    }
    .card-header {
        border-bottom: none;
    }
    .btn-warning:hover {
        background-color: #e0a800;
        border-color: #d39e00;
    }
    .btn-danger:hover {
        background-color: #c82333;
        border-color: #bd2130;
    }
    .ms-auto {
        margin-left: auto !important;
    }
    .list-group-item {
        border-radius: 0.375rem;
        margin-bottom: 0.5rem;
        transition: background-color 0.2s;
    }
    .list-group-item:hover {
        background-color: #f1f1f1;
    }
    .rounded-circle {
        border: 2px solid #ffc107;
    }
    .nav-tabs .nav-link {
        color: #333;
        border-radius: 0.375rem 0.375rem 0 0;
    }
    .nav-tabs .nav-link.active {
        background-color: #ffc107;
        color: #fff;
        border-color: #ffc107;
    }
</style>
@endsection