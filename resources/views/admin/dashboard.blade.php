<script type="text/javascript">
        var gk_isXlsx = false;
        var gk_xlsxFileLookup = {};
        var gk_fileData = {};
        function filledCell(cell) {
          return cell !== '' && cell != null;
        }
        function loadFileData(filename) {
        if (gk_isXlsx && gk_xlsxFileLookup[filename]) {
            try {
                var workbook = XLSX.read(gk_fileData[filename], { type: 'base64' });
                var firstSheetName = workbook.SheetNames[0];
                var worksheet = workbook.Sheets[firstSheetName];

                // Convert sheet to JSON to filter blank rows
                var jsonData = XLSX.utils.sheet_to_json(worksheet, { header: 1, blankrows: false, defval: '' });
                // Filter out blank rows (rows where all cells are empty, null, or undefined)
                var filteredData = jsonData.filter(row => row.some(filledCell));

                // Heuristic to find the header row by ignoring rows with fewer filled cells than the next row
                var headerRowIndex = filteredData.findIndex((row, index) =>
                  row.filter(filledCell).length >= filteredData[index + 1]?.filter(filledCell).length
                );
                // Fallback
                if (headerRowIndex === -1 || headerRowIndex > 25) {
                  headerRowIndex = 0;
                }

                // Convert filtered JSON back to CSV
                var csv = XLSX.utils.aoa_to_sheet(filteredData.slice(headerRowIndex)); // Create a new sheet from filtered array of arrays
                csv = XLSX.utils.sheet_to_csv(csv, { header: 1 });
                return csv;
            } catch (e) {
                console.error(e);
                return "";
            }
        }
        return gk_fileData[filename] || "";
        }
        </script>```html
@extends('layouts.admin')

@section('content')
<div class="container-fluid py-5" style="background-color: #f5f7fa; min-height: 100vh;">
    <div class="container">
        <h1 class="mb-5 text-center fw-bold" style="color: #191c24;">لوحة التحكم</h1>

        <!-- كروت الملخصات -->
        <div class="row g-4 mb-5">
            <div class="col-md-3 col-sm-6">
                <div class="card shadow border-0 h-100" style="border-radius: 12px;">
                    <div class="card-body d-flex align-items-center">
                        <div class="me-3">
                            <i class="bi bi-cart-fill" style="font-size: 2rem; color: #ffc107;"></i>
                        </div>
                        <div>
                            <h6 class="card-title mb-1" style="color: #191c24;">طلبات اليوم</h6>
                            <p class="card-text fw-bold mb-1" style="font-size: 1.8rem; color: #ffc107;">{{ $todayOrders }}</p>
                            <small style="color: #6c757d;">مقارنة بالأمس: <span class="{{ $ordersChange >= 0 ? 'text-success' : 'text-danger' }}">{{ $ordersChange }}%</span></small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="card shadow border-0 h-100" style="border-radius: 12px;">
                    <div class="card-body d-flex align-items-center">
                        <div class="me-3">
                            <i class="bi bi-currency-dollar" style="font-size: 2rem; color: #ffc107;"></i>
                        </div>
                        <div>
                            <h6 class="card-title mb-1" style="color: #191c24;">الإيرادات اليوم</h6>
                            <p class="card-text fw-bold mb-1" style="font-size: 1.8rem; color: #ffc107;">{{ number_format($todayRevenue, 2) }} ر.س</p>
                            <small style="color: #6c757d;">إجمالي المبيعات</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="card shadow border-0 h-100" style="border-radius: 12px;">
                    <div class="card-body d-flex align-items-center">
                        <div class="me-3">
                            <i class="bi bi-calendar-check" style="font-size: 2rem; color: #ffc107;"></i>
                        </div>
                        <div>
                            <h6 class="card-title mb-1" style="color: #191c24;">حجوزات اليوم</h6>
                            <p class="card-text fw-bold mb-1" style="font-size: 1.8rem; color: #ffc107;">{{ $todayBookings }}</p>
                            <small style="color: #6c757d;">إجمالي الحجوزات</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="card shadow border-0 h-100" style="border-radius: 12px;">
                    <div class="card-body d-flex align-items-center">
                        <div class="me-3">
                            <i class="bi bi-hourglass-split" style="font-size: 2rem; color: #ffc107;"></i>
                        </div>
                        <div>
                            <h6 class="card-title mb-1" style="color: #191c24;">طلبات معلقة</h6>
                            <p class="card-text fw-bold mb-1" style="font-size: 1.8rem; color: #ffc107;">{{ $pendingOrders }}</p>
                            <small style="color: #6c757d;">في انتظار المعالجة</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- الإحصائيات والتنبيهات -->
        <div class="row g-4 mb-5">
            <div class="col-md-8">
                <div class="card shadow border-0" style="border-radius: 12px;">
                    <div class="card-header bg-white border-0 pb-0">
                        <h5 class="fw-bold" style="color: #191c24;">توزيع حالات الطلبات</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="orderStatusChart" height="200"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow border-0" style="border-radius: 12px;">
                    <div class="card-header bg-white border-0 pb-0">
                        <h5 class="fw-bold" style="color: #191c24;">تنبيهات</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            @if($pendingOrders > 0)
                                <li class="list-group-item border-0 py-1" style="color: #191c24;">
                                    <i class="bi bi-exclamation-circle me-2" style="color: #ffc107;"></i>
                                    لديك {{ $pendingOrders }} طلبات معلقة
                                </li>
                            @endif
                            @if($pendingBookings > 0)
                                <li class="list-group-item border-0 py-1" style="color: #191c24;">
                                    <i class="bi bi-exclamation-circle me-2" style="color: #ffc107;"></i>
                                    لديك {{ $pendingBookings }} حجوزات معلقة
                                </li>
                            @endif
                            @if($urgentBookings > 0)
                                <li class="list-group-item border-0 py-1" style="color: #191c24;">
                                    <i class="bi bi-exclamation-circle me-2" style="color: #ffc107;"></i>
                                    لديك {{ $urgentBookings }} حجوزات خلال الساعتين القادمتين
                                </li>
                            @endif
                            @if($pendingOrders == 0 && $pendingBookings == 0 && $urgentBookings == 0)
                                <li class="list-group-item border-0 py-1" style="color: #191c24;">
                                    <i class="bi bi-check-circle me-2" style="color: #28a745;"></i>
                                    لا توجد تنبيهات حاليًا
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- جدول صغير -->
        <div class="row g-4">
            <div class="col-12">
                <div class="card shadow border-0" style="border-radius: 12px;">
                    <div class="card-header bg-white border-0 pb-0">
                        <h5 class="fw-bold" style="color: #191c24;">آخر الطلبات والحجوزات</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-borderless">
                            <thead>
                                <tr style="color: #191c24;">
                                    <th>النوع</th>
                                    <th>الاسم</th>
                                    <th>التاريخ</th>
                                    <th>الحالة</th>
                                    <th>إجراء</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recentItems as $item)
                                    <tr>
                                        <td>{{ $item['type'] }}</td>
                                        <td>{{ $item['name'] }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item['date'])->format('Y-m-d H:i') }}</td>
                                        <td>
                                            <span class="badge bg-{{ $item['status'] == 'pending' ? 'warning' : ($item['status'] == 'completed' || $item['status'] == 'confirmed' ? 'success' : 'danger') }} text-white">
                                                {{ $item['status'] == 'pending' ? 'معلق' : ($item['status'] == 'completed' || $item['status'] == 'confirmed' ? 'مكتمل' : 'ملغى') }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="#" 
                                               class="btn btn-sm btn-outline-secondary" style="border-color: #ffc107; color: #ffc107;">
                                                عرض
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('orderStatusChart').getContext('2d');
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['معلق', 'مكتمل', 'ملغى'],
            datasets: [{
                data: [{{ $pendingOrdersCount }}, {{ $completedOrdersCount }}, {{ $cancelledOrdersCount }}],
                backgroundColor: ['#ffc107', '#28a745', '#dc3545'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'top', labels: { color: '#191c24', font: { size: 14 } } },
                tooltip: { backgroundColor: '#191c24', titleColor: '#ffffff', bodyColor: '#ffffff' }
            },
            cutout: '60%'
        }
    });
});
</script>

<style>
    body {
        font-family: 'Arial', sans-serif;
    }
    .card {
        border-radius: 12px;
        transition: transform 0.2s;
    }
    .card:hover {
        transform: translateY(-5px);
    }
    .card-title, .card-text {
        margin: 0;
    }
    .table th, .table td {
        vertical-align: middle;
        color: #191c24;
    }
    .table thead th {
        border-bottom: 2px solid #e0e0e0;
    }
    .badge {
        padding: 6px 12px;
        font-size: 0.9rem;
    }
    .btn-outline-secondary:hover {
        background-color: #ffc107;
        color: #191c24;
    }
    .container {
        max-width: 1400px;
    }
</style>
@endsection
```