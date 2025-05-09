@extends('layouts.app')

@section('content')
<div class="container mt-5 mb-4">
    <div class="row justify-content-center ">
        <!-- كارد المعلومات الشخصية -->
        <div class="col-md-8 mb-4 text-right">
            <div class="card shadow-lg rounded">
                <div class="card-header bg-primary text-white text-center">
                    <h5 class="mb-0">المعلومات الشخصية</h5>
                </div>
                <div class="card-body text-center">
                    <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="User Icon" width="100" class="mb-3">
                    <h4 class="card-title mb-3">{{ Auth::user()->name }}</h4>
                    <p class="card-text"><strong>البريد الإلكتروني:</strong> {{ Auth::user()->email }}</p>
                    <p class="card-text"><strong>تاريخ التسجيل:</strong> {{ Auth::user()->created_at->format('Y-m-d') }}</p>
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                       class="btn btn-danger mt-3">
                        تسجيل الخروج
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>

        <!-- كارد الطلبات السابقة -->
        <div class="col-md-8 text-right">
            <div class="card shadow rounded">
                <div class="card-header bg-secondary text-white text-center">
                    <h5 class="mb-0">الطلبات السابقة</h5>
                </div>
                <div class="card-body">
                    <!-- مثال مبدأي، استبدله لاحقاً بالطلبات من قاعدة البيانات -->
                    <ul class="list-group text-right">
                        <li class="list-group-item">طلب رقم #123 - 2024-06-10</li>
                        <li class="list-group-item">طلب رقم #122 - 2024-06-01</li>
                        <li class="list-group-item">طلب رقم #121 - 2024-05-25</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
