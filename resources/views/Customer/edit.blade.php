@extends('layouts.app')

@section('content')
<div class="container py-5" dir="rtl">
    <div class="row">
        <div class="col-md-6 col-lg-5 ms-auto">
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-header bg-warning text-white text-center py-3 rounded-top">
                    <h4 class="mb-0">{{ __('تحرير الملف الشخصي') }}</h4>
                </div>
                <div class="card-body p-4">
                    @if (session('status'))
                        <div class="alert alert-success text-end" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('customer.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="name" class="form-label text-end w-100">{{ __('الاسم') }}</label>
                            <div class="input-group">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', Auth::user()->name) }}" required>
                                <span class="input-group-text bg-light"><i class="bi bi-person-fill"></i></span>
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="phone" class="form-label text-end w-100">{{ __('رقم الهاتف') }}</label>
                            <div class="input-group">
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone', Auth::user()->phone) }}">
                                <span class="input-group-text bg-light"><i class="bi bi-phone-fill"></i></span>
                                @error('phone')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-grid gap-2 mb-3">
                            <button type="submit" class="btn btn-warning text-white rounded-pill py-2">
                                {{ __('حفظ التغييرات') }}
                            </button>
                        </div>

                        <div class="text-end">
                            <a href="{{ route('customer.profile') }}" class="text-warning fw-bold text-decoration-none">{{ __('العودة إلى الملف الشخصي') }}</a>
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
    .ms-auto {
        margin-left: auto !important;
    }
    .container {
        text-align: right !important;
    }
    .row {
        justify-content: flex-end !important;
    }
    .alert-success {
        border-radius: 0.375rem;
    }
</style>
@endsection