@extends('layouts.admin')

@section('content')
<div class="container py-5" dir="rtl">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-header bg-warning text-white text-center py-3 rounded-top">
                    <h4 class="mb-0">{{ __('إدارة الطلبات') }}</h4>
                </div>
                <div class="card-body p-4">
                    @if (session('status'))
                        <div class="alert alert-success text-end" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- جدول الطلبات -->
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-warning">
                                <tr>
                                    <th style="background-color: #191c24;">{{ __('رقم الطلب') }}</th>
                                    <th style="background-color: #191c24;">{{ __('اسم العميل') }}</th>
                                    <th style="background-color: #191c24;">{{ __('الإيميل') }}</th>
                                    <th style="background-color: #191c24;">{{ __('وقت الاستلام') }}</th>
                                    <th style="background-color: #191c24;">{{ __('السعر الإجمالي') }}</th>
                                    <th style="background-color: #191c24;">{{ __('الحالة') }}</th>
                                    <th style="background-color: #191c24;">{{ __('الإجراءات') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>#{{ $order->id }}</td>
                                        <td>{{ $order->customer_name }}</td>
                                        <td>{{ $order->customer_email }}</td>
                                        <td>{{ \Carbon\Carbon::parse($order->pickup_time)->format('Y-m-d H:i') }}</td>
                                        <td>{{ number_format($order->total_price, 2) }} {{ __('ر.س') }}</td>
                                        <td>
                                            <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <select name="status" class="form-select form-select-sm status-select" onchange="this.form.submit()">
                                                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }} data-color="pending">
                                                        <i class="bi bi-hourglass-split me-1"></i> {{ __('معلق') }}
                                                    </option>
                                                    <option value="preparing" {{ $order->status == 'preparing' ? 'selected' : '' }} data-color="preparing">
                                                        <i class="bi bi-gear-fill me-1"></i> {{ __('قيد التحضير') }}
                                                    </option>
                                                    <option value="ready" {{ $order->status == 'ready' ? 'selected' : '' }} data-color="ready">
                                                        <i class="bi bi-check-circle-fill me-1"></i> {{ __('جاهز') }}
                                                    </option>
                                                    <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }} data-color="completed">
                                                        <i class="bi bi-check-all me-1"></i> {{ __('مكتمل') }}
                                                    </option>
                                                </select>
                                            </form>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-warning btn-sm rounded-pill me-1">
                                                {{ __('عرض التفاصيل') }}
                                            </a>
                                            <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm rounded-pill delete-button" title="{{ __('إلغاء الطلب') }}">
                                                    <i class="bi bi-x-circle-fill"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- التنقل بين الصفحات -->
                    <div class="mt-4">
                        {{ $orders->links() }}
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
    .form-select-sm {
        width: 140px !important;
        padding: 0.25rem 1.5rem 0.25rem 0.5rem !important; /* زيادة padding لليمين عشان السهم */
        font-size: 0.9rem !important;
        border-radius: 0.25rem !important;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23333' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e") !important;
        background-position: left 0.25rem center !important; /* نقل السهم لليسار */
        background-repeat: no-repeat !important;
        background-size: 16px 12px !important;
        appearance: none !important; /* إزالة السهم الافتراضي */
    }
    .status-select.pending {
        background-color: #fff3cd !important;
        border-color: #ffc107 !important;
        color: #856404 !important;
    }
    .status-select.preparing {
        background-color: #ffe5d0 !important;
        border-color: #fd7e14 !important;
        color: #853c0a !important;
    }
    .status-select.ready {
        background-color: #d4edda !important;
        border-color: #28a745 !important;
        color: #155724 !important;
    }
    .status-select.completed {
        background-color: #d1ecf1 !important;
        border-color: #007bff !important;
        color: #0c5460 !important;
    }
    .status-select.cancelled {
        background-color: #f8d7da !important;
        border-color: #dc3545 !important;
        color: #721c24 !important;
    }
    .status-select option {
        background-color: #fff !important;
        color: #333 !important;
    }
    .btn-danger {
        background-color: #dc3545 !important;
        border-color: #dc3545 !important;
    }
    .btn-danger:hover {
        background-color: #c82333 !important;
        border-color: #bd2130 !important;
    }
    /* تنسيق أزرار SweetAlert2 */
    .no-outline {
        border: none !important;
        box-shadow: none !important;
    }
    @media (max-width: 576px) {
        .table-responsive {
            font-size: 0.85rem !important;
        }
        .form-select-sm {
            width: 120px !important;
            padding: 0.2rem 1.25rem 0.2rem 0.4rem !important;
            font-size: 0.8rem !important;
        }
        .btn-sm {
            padding: 0.2rem 0.4rem !important;
            font-size: 0.75rem !important;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // تحديث ألوان القائمة المنسدلة
        document.querySelectorAll('.status-select').forEach(select => {
            updateSelectColor(select);
            select.addEventListener('change', function () {
                updateSelectColor(this);
            });
        });

        function updateSelectColor(select) {
            select.classList.remove('pending', 'preparing', 'ready', 'completed', 'cancelled');
            const selectedOption = select.options[select.selectedIndex];
            const colorClass = selectedOption.getAttribute('data-color');
            select.classList.add(colorClass);
        }

        // SweetAlert2 لتأكيد الإلغاء
        document.querySelectorAll('.delete-button').forEach(function(button) {
            button.addEventListener('click', function(e) {
                e.preventDefault(); // منع الإرسال الافتراضي

                const form = this.closest('form'); // أخذ الـ form اللي يحتوي الزر

                Swal.fire({
                    title: "{{ __('هل أنت متأكد من إلغاء الطلب؟') }}",
                    showCancelButton: true,
                    confirmButtonText: "{{ __('تأكيد') }}",
                    cancelButtonText: "{{ __('إلغاء') }}",
                    confirmButtonColor: '#d33',
                    customClass: {
                        confirmButton: 'no-outline',
                        cancelButton: 'no-outline'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: "{{ __('تم إلغاء الطلب بنجاح') }}",
                            icon: 'success',
                            confirmButtonText: "{{ __('موافق') }}",
                            confirmButtonColor: '#3085d6'
                        }).then(() => {
                            form.submit(); // إرسال الـ form بعد التأكيد
                        });
                    }
                });
            });
        });
    });
</script>
@endsection