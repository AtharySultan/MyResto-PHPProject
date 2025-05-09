@extends('layouts.admin')

@section('content')

<div class="filter-container">
    <button class="filter-btn active rounded-pill" data-filter="all">الكل</button>
    @foreach ($categories as $category)
        <button class="filter-btn rounded-pill" data-filter="{{ $category->id }}">{{ $category->name }}</button>
    @endforeach
</div>

<div class="cards-container">
    @foreach ($dishes as $dish)
        <div class="menu-card" data-category-id="{{ $dish->category->id }}">
            <img src="{{ asset('storage/' . $dish->image) }}" alt="{{ $dish->name }}">
            <h3>{{ $dish->name }}</h3>
            <p>{{ $dish->description }}</p>
            <div class="price">{{ $dish->price }} ر.س</div>
            <div class="actions">
            <a href="{{route('admin.dishes.edit' , $dish->id)}}" class=""><i class="far fa-edit edit-icon"></i></a>
            <td class="text-center">
              <a href="{{ route('admin.dishes.delete', ['id' => $dish->id]) }}" class="delete-button" style="background: none; border: none; cursor: pointer;">
                <i class="far fa-trash-alt delete-icon"></i>
              </a>
          </td>
            </div>
        </div>
    @endforeach
</div>







@endsection
