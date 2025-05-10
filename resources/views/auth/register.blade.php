@extends('layouts.app')

@section('content')
<div class="container py-5" dir="rtl">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-header bg-warning text-white text-center py-3 rounded-top">
                    <h4 class="mb-0">{{ __('إنشاء حساب جديد') }}</h4>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- حقل الاسم -->
                        <div class="mb-4">
                            <label for="name" class="form-label">{{ __('الاسم') }}</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-person-fill"></i></span>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <!-- حقل البريد الإلكتروني -->
                        <div class="mb-4">
                            <label for="email" class="form-label">{{ __('البريد الإلكتروني') }}</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-envelope-fill"></i></span>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <!-- حقل كلمة المرور -->
                        <div class="mb-4">
                            <label for="password" class="form-label">{{ __('كلمة المرور') }}</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-lock-fill"></i></span>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <!-- حقل تأكيد كلمة المرور -->
                        <div class="mb-4">
                            <label for="password-confirm" class="form-label">{{ __('تأكيد كلمة المرور') }}</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-lock-fill"></i></span>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <!-- زر التسجيل -->
                        <div class="d-grid gap-2 mb-3">
                            <button type="submit" class="btn btn-warning text-white rounded-pill py-2">
                                {{ __('إنشاء الحساب') }}
                            </button>
                         </div>

<!-- رابط تسجيل الدخول -->
<div class="text-center">
    <span class="text-muted">{{ __('لديك حساب؟') }}</span>
    <a class="text-warning fw-bold text-decoration-none" href="{{ route('login') }}">
        {{ __('تسجيل الدخول') }}
    </a>
</div>
</form>
</div>
</div>
</div>
</div>
</div>

<style>
.card {
background: #fff;
border-radius: 15px;
overflow: hidden;
}
.card-header {
border-bottom: none;
}
.input-group-text {
border: none;
background: #f8f9fa;
}
.form-control {
border-radius: 0 0.375rem 0.375rem 0;
border-left: none;
}
.btn-warning:hover {
background-color: #e0a800;
border-color: #d39e00;
}
.text-warning:hover {
text-decoration: underline;
}

.container {
        text-align: right !important;
    }
</style>
@endsection