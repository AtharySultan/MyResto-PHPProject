@extends('layouts.admin')
@section('content')
<div class="container pt-4">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header" style="background-color: #191C24;">
                    <h3 style="color: aliceblue;">إضافة فئة جديدة</h3>
                </div>
                <div class="card-body">
                <form action="{{ route('categories.store') }}" method="POST">
                @csrf
                        <div class="row">
                            <div class="col">
                                
                            <div class="mb-3">
                                <label class=''>اسم الفئة</label>
                                <input type="text" name="categ_name"  class="form-control" placeholder="أدخل الاسم" style="background-color: #f0f0f0;" >
                                <!-- اذا ابغى رسالة الخطأ تظهر لازم اشيل الريكوايرد لأنها حقت البوتستراب-->

                                @error('categ_name')
                                <small class="text-danger">({ $message })</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class=''>وصف </label>
                                <input type="text" name="categ_description" class="form-control" placeholder="أدخل الوصف" style="background-color: #f0f0f0;" >
                            </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <button type="submit" class='btn btn-primary rounded-pill' style="background-color: #ffc107; color: #ffffff;  border-color: #ffc107;">حفظ</button>
                            </div>
                        </div>


                    </form>
                </div>
             </div> 
<!-- كارد يحتوي على جدول الفئات -->
<div class="card mt-4">
    <div class="card-header" style="background-color: #191C24;">
        <h3 style="color: aliceblue;">جدول الفئات</h3>
    </div>
    <div class="card-body">
        <table class="table table-bordered text-center">
            <thead class="table-dark">
                <tr>
                    <th style="background-color: rgb(68, 68, 80);">رقم الفئة</th>
                    <th style="background-color: rgb(68, 68, 80);">اسم الفئة</th>
                    <th style="background-color: rgb(68, 68, 80);">وصف الفئة</th>

                    <th colspan="2" style="background-color: rgb(68, 68, 80);">إجراء</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->description }}</td>

                        <td>
                            <a href="{{ route('categories.edit', $category->id) }}" class=""><i class="far fa-edit edit-icon"></i></a>
                            
                        </td>
                        <td class="text-center">
                            <a href="{{ route('categories.delet', ['id' => $category->id]) }}" class="delete-button-cat" style="background: none; border: none; cursor: pointer;">
                                <i class="bi bi-trash-fill text-danger"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

             
             
            
@endsection
