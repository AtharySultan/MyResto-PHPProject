@extends('layouts.app')

@section('content')
<div class="container py-5" dir="rtl">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-header bg-warning text-white text-center py-3 rounded-top">
                    <h4 class="mb-0">{{ __('تسجيل الدخول') }}</h4>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- حقل البريد الإلكتروني -->
                        <div class="mb-4">
                            <label for="email" class="form-label">{{ __('البريد الإلكتروني') }}</label>
                            <div class="input-group text-end">
                                <span class="input-group-text bg-light"><i class="bi bi-envelope-fill"></i></span>
                                <input id="email" type="email" class="form-control  @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
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
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <!-- تذكرني -->
                        <div class="mb-4 form-check d-flex justify-content-end align-items-center gap-2">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                {{ __('تذكرني') }}
                            </label>
                        </div>

                        <!-- أزرار الإجراءات -->
                        <div class="d-grid gap-2 mb-3">
                            <button type="submit" class="btn btn-warning text-white rounded-pill py-2">
                                {{ __('تسجيل الدخول') }}
                            </button>
                        </div>

                        <div class="text-center">
                            @if (Route::has('password.request'))
                                <a class="text-muted text-decoration-none" href="{{ route('password.request') }}">
                                    {{ __('نسيت كلمة المرور؟') }}
                                </a>
                            @endif
                            <span class="mx-2">|</span>
                            <a class="text-warning fw-bold text-decoration-none" href="{{ route('register') }}">
                                {{ __('إنشاء حساب جديد') }}
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
    .form-check-input:checked {
        background-color: #ffc107;
        border-color: #ffc107;
    }
    .text-warning:hover {
        text-decoration: underline;
    }

    .container {
        text-align: right !important;
    }

</style>
</style>
@endsection