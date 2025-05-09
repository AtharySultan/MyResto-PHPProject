@extends('layouts.admin')
@section('content')
<div class="container pt-4">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header" style="background-color: #191C24;">
                    <h3 style="color: aliceblue;">إضافة طبق جديد</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.dishes.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col">
                                <!-- إضافة Dropdown لاختيار الفئة -->
                                <label class=''>اختر الفئة</label>
                                <select name="category_id" class="form-control" style="background-color: #f0f0f0;" required>
                                    <option value="">اختر فئة</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col">
                                <label class=''>اسم الطبق</label>
                                <input type="text" name="name" class="form-control" placeholder="أدخل الاسم" style="background-color: #f0f0f0;" required>
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col">
                                <label class=''>وصف الطبق</label>
                                <input type="text" name="description" class="form-control" placeholder="أدخل الوصف" style="background-color: #f0f0f0;" required>
                            </div>

                            <div class="col">
                                <label class=''>السعر</label>
                                <input type="text" name="price" class="form-control" placeholder="أدخل السعر" style="background-color: #f0f0f0;" required>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col col-md-4">
                                <input type="file" name="image" class="form-control" required>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col">
                                <button type="submit" class='btn btn-primary rounded-pill' style="background-color: #ffc107; color: #ffffff; border-color: #ffc107;">حفظ</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>      
        </div>
    </div>

    <!-- جدول الأطباق -->
    <div class="card mt-5">
        <div class="card-header" style="background-color: #191C24;">
            <h3 style="color: aliceblue;">جدول الأطباق</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered text-center">
                <thead class="table-dark">
                    <tr>
                        <th style="background-color: rgb(68, 68, 80);">رقم </th>
                        <th style="background-color: rgb(68, 68, 80);">اسم الطبق</th>
                        <th style="background-color: rgb(68, 68, 80);">وصف الطبق</th>
                        <th style="background-color: rgb(68, 68, 80);">السعر</th>
                        <th style="background-color: rgb(68, 68, 80);">صورة الطبق</th>
                        <th style="background-color: rgb(68, 68, 80);" colspan="2">إجراء</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dishes as $dish)
                        <tr>
                            <td>{{ $dish->id }}</td>
                            <td>{{ $dish->name }}</td>
                            <td>{{ $dish->description }}</td>
                            <td>{{ $dish->price }}</td>
                            <td><img src="{{ asset('storage/' . $dish->image) }}" width="100" height="100" alt="Dish Image"></td>
                            <td>
                                <a href="{{route('admin.dishes.edit' , $dish->id)}}" class=""><i class="far fa-edit" style="color: #ffc107;"></i></a>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.dishes.delete', ['id' => $dish->id]) }}" class="delete-button" style="background: none; border: none; cursor: pointer;">
                                    <i class="bi bi-trash-fill text-danger"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
