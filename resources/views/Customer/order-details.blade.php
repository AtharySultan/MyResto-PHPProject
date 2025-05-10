@extends('layouts.app')

@section('content')
<div class="profile-container py-5" dir="rtl">
    <div class="row">
        <div class="col-md-10 col-lg-8 mx-auto">
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-header bg-warning text-white text-center py-3 rounded-top">
                    <h4 class="mb-0">{{ __('تفاصيل الطلب رقم #') }}{{ $order->id }}</h4>
                </div>
                <div class="card-body p-4">
                    @if (session('status'))
                        <div class="alert alert-success text-end" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- معلومات الطلب -->
                    <div class="row text-end mb-4">
                        <div class="col-md-6 mb-3">
                            <p><i class="bi bi-calendar-event-fill me-2"></i><strong>{{ __('تاريخ الطلب') }}:</strong> {{ $order->created_at->format('Y-m-d H:i') }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <p><i class="bi bi-clock-fill me-2"></i><strong>{{ __('وقت الاستلام') }}:</strong> {{ \Carbon\Carbon::parse($order->pickup_time)->format('Y-m-d H:i') }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <p><i class="bi bi-person-fill me-2"></i><strong>{{ __('اسم العميل') }}:</strong> {{ $order->customer_name }}</p>
                        </div>
                    </div>

                    <!-- الأصناف -->
                    <h5 class="text-end mb-3">{{ __('الأصناف') }}</h5>
                    <table class="table table-hover">
                        <thead class="table-warning">
                            <tr>
                                <th>{{ __('الطبق') }}</th>
                                <th>{{ __('الكمية') }}</th>
                                <th>{{ __('السعر') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->orderItems as $item)
                                <tr>
                                    <td>{{ $item->dish->name }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ number_format($item->unit_price * $item->quantity, 2) }} {{ __('ر.س') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="total-row">
                                <td colspan="2" class="text-end"><strong>{{ __('الإجمالي') }}:</strong></td>
                                <td><strong>{{ number_format($order->total_price, 2) }} {{ __('ر.س') }}</strong></td>
                            </tr>
                        </tfoot>
                    </table>

                    <!-- تايم لاين حالة الطلب -->
                    <h5 class="text-end mb-4">{{ __('حالة الطلب') }}</h5>
                    <div class="timeline">
                        @php
                            $statuses = [
                                'pending' => ['label' => __('معلق'), 'icon' => 'bi-hourglass-split', 'active' => $order->status == 'pending' || in_array($order->status, ['preparing', 'ready', 'completed'])],
                                'preparing' => ['label' => __('قيد التحضير'), 'icon' => 'bi-gear-fill', 'active' => $order->status == 'preparing' || in_array($order->status, ['ready', 'completed'])],
                                'ready' => ['label' => __('جاهز'), 'icon' => 'bi-check-circle-fill', 'active' => $order->status == 'ready' || $order->status == 'completed'],
                                'completed' => ['label' => __('مكتمل'), 'icon' => 'bi-check-all', 'active' => $order->status == 'completed'],
                            ];
                            if ($order->status == 'cancelled') {
                                $statuses['cancelled'] = ['label' => __('ملغي'), 'icon' => 'bi-x-circle-fill', 'active' => true];
                            }
                        @endphp
                        <div class="timeline-container">
                            @foreach ($statuses as $key => $status)
                                <div class="timeline-step {{ $status['active'] ? 'active' : '' }} {{ $key == $order->status ? 'current' : '' }}">
                                    <div class="timeline-icon">
                                        <i class="bi {{ $status['icon'] }}"></i>
                                    </div>
                                    <div class="timeline-label">
                                        <h6>{{ $status['label'] }}</h6>
                                        <p>
                                            @if ($key == $order->status)
                                                {{ __('الحالة الحالية') }}
                                            @elseif ($status['active'])
                                                {{ __('تم') }}
                                            @else
                                                {{ __('لم يتم بعد') }}
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="text-end mt-4">
                        <a href="{{ route('customer.profile') }}" class="btn btn-warning rounded-pill py-2 px-4">{{ __('العودة إلى الملف الشخصي') }}</a>
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
        justify-content: flex-end !important;
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
        background-color: #ffc107;
        color: #fff;
    }
    .btn-warning:hover {
        background-color: #e0a800;
        border-color: #d39e00;
    }
    .ms-auto {
        margin-left: auto !important;
    }
    .table-hover tbody tr:hover {
        background-color: #f1f1f1;
    }
    .alert-success {
        border-radius: 0.375rem;
    }
    .total-row {
        background-color: #fff3cd;
        font-weight: bold;
        font-size: 1.1rem;
    }
    .total-row td {
        padding: 12px;
        border-top: 2px solid #ffc107;
    }

    /* تصميم التايم لاين الجديد */
    .timeline {
        padding: 20px 0;
    }
    .timeline-container {
        display: flex;
        flex-direction: column;
        position: relative;
        padding-right: 50px;
    }
    .timeline-container:before {
        content: '';
        position: absolute;
        top: 0;
        bottom: 0;
        width: 4px;
        background: #e9ecef;
        right: 28px;
        z-index: 0;
    }
    .timeline-step {
        display: flex;
        align-items: center;
        position: relative;
        margin-bottom: 20px;
        flex-direction: row-reverse;
    }
    .timeline-icon {
        width: 40px;
        height: 40px;
        background: #e9ecef;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-left: 10px;
        z-index: 1;
        transition: all 0.3s ease;
    }
    .timeline-step.active .timeline-icon {
        background: #ffc107;
        color: #fff;
    }
    .timeline-step.current .timeline-icon {
        background: #28a745;
        color: #fff;
        transform: scale(1.1);
    }
    .timeline-label {
        flex: 1;
        text-align: right;
    }
    .timeline-label h6 {
        margin: 0;
        font-weight: bold;
        font-size: 1rem;
        color: #333;
    }
    .timeline-step.active .timeline-label h6 {
        color: #ffc107;
    }
    .timeline-step.current .timeline-label h6 {
        color: #28a745;
    }
    .timeline-label p {
        margin: 0;
        font-size: 0.9rem;
        color: #666;
    }

    /* استجابة للشاشات الصغيرة */
    @media (max-width: 576px) {
        .timeline-container {
            padding-right: 40px;
        }
        .timeline-container:before {
            right: 18px;
        }
        .timeline-icon {
            width: 30px;
            height: 30px;
            margin-left: 8px;
        }
        .timeline-label h6 {
            font-size: 0.9rem;
        }
        .timeline-label p {
            font-size: 0.8rem;
        }
    }

    /* استجابة للشاشات الكبيرة */
    @media (min-width: 992px) {
        .timeline-container {
            padding-right: 60px;
        }
        .timeline-label h6 {
            font-size: 1.1rem;
        }
        .timeline-label p {
            font-size: 1rem;
        }
    }
</style>
@endsection