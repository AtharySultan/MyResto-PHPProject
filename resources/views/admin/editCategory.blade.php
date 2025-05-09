@extends('layouts.admin')

@section('content')
<div class="container pt-4">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header" style="background-color: #191C24;">
                    <h3 style="color: aliceblue;">تعديل الفئة</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('categories.update', $category->id) }}" method="POST">
                        @csrf
                        @method('PUT') <!-- مهم لتحديد أنه تعديل -->

                        <div class="row">
                            <div class="col">

                                <div class="mb-3">
                                    <label class=''>اسم الفئة</label>
                                    <input type="text" name="categ_name" class="form-control" placeholder="أدخل الاسم" value="{{ old('categ_name', $category->name) }}" style="background-color: #f0f0f0;">
                                    @error('categ_name')
                                    <small class="text-danger">({{ $message }})</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class=''>وصف</label>
                                    <input type="text" name="categ_description" class="form-control" placeholder="أدخل الوصف" value="{{ old('categ_description', $category->description) }}" style="background-color: #f0f0f0;">
                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <button type="submit" class='btn btn-primary rounded-pill' style="background-color: #ffc107; color: #ffffff;  border-color: #ffc107;">تحديث</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
@endsection
