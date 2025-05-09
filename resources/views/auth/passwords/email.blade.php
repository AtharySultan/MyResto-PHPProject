@extends('layouts.app')

@section('content')
<div class="container py-5" dir="rtl">
    <div class="row">
        <div class="col-md-6 col-lg-5 ms-auto">
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-header bg-warning text-white text-center py-3 rounded-top">
                    <h4 class="mb-0">{{ __('طلب إعادة تعيين كلمة المرور') }}</h4>
                </div>
                <div class="card-body p-4">
                    @if (session('status'))
                        <div class="alert alert-success text-end" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <!-- حقل البريد الإلكتروني -->
                        <div class="mb-4">
                            <label for="email" class="form-label text-end w-100">{{ __('البريد الإلكتروني') }}</label>
                            <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-envelope-fill"></i></span>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <!-- زر إرسال رابط إعادة التعيين -->
                        <div class="d-grid gap-2 mb-3">
                            <button type="submit" class="btn btn-warning text-white rounded-pill py-2">
                                {{ __('إرسال رابط إعادة تعيين كلمة المرور') }}
                            </button>
                        </div>

                        <!-- رابط تسجيل الدخول -->
                        <div class="text-end">
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
        border-radius: 0.375rem 0 0 0.375rem;
        border-right: none;
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

    .alert-success {
        border-radius: 0.375rem;
    }
</style>
@endsection