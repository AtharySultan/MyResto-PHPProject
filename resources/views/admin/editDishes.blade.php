@extends('layouts.admin')
@section('content')
<div class="container pt-4">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header" style="background-color: #191C24;">
                    <h3 style="color: aliceblue;">تعديل الطبق</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.dishes.update', $dish->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col">
                                <label class=''>اختر الفئة</label>
                                <select name="category_id" class="form-control" style="background-color: #f0f0f0;" required>
                                    <option value="">اختر فئة</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ $dish->category_id == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col">
                                <label class=''>اسم الطبق</label>
                                <input type="text" name="name" class="form-control" value="{{ $dish->name }}" placeholder="أدخل الاسم" style="background-color: #f0f0f0;" required>
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col">
                                <label class=''>وصف الطبق</label>
                                <input type="text" name="description" class="form-control" value="{{ $dish->description }}" placeholder="أدخل الوصف" style="background-color: #f0f0f0;" required>
                            </div>

                            <div class="col">
                                <label class=''>السعر</label>
                                <input type="text" name="price" class="form-control" value="{{ $dish->price }}" placeholder="أدخل السعر" style="background-color: #f0f0f0;" required>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col col-md-4">
                                <label class=''>تغيير الصورة (اختياري)</label>
                                <input type="file" name="image" class="form-control">
                                @if($dish->image)
                                    <img src="{{ asset('images/' . $dish->image) }}" width="100" class="mt-2">
                                @endif
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col">
                                <button type="submit" class='btn btn-primary rounded-pill' style="background-color: #ffc107; color: #ffffff; border-color: #ffc107;">حفظ التعديلات</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>      
        </div>
    </div>
</div>
@endsection
