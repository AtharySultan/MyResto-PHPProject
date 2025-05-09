@extends('layouts.app')

@section('content')
  <!-- food section -->

  <section class="food_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Our Menu
        </h2>
      </div>

      
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
              </div>
          @endforeach
      </div>

@endsection
