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
      
      <div class="cards-container ">
          @foreach ($dishes as $dish)
          <div class="menu-card" data-category-id="{{ $dish->category->id }}" data-dish-id="{{ $dish->id }}">
            <img src="{{ asset('storage/' . $dish->image) }}" alt="{{ $dish->name }}">
            <h3 class="text-end">{{ $dish->name }}</h3>
            <p style="text-align: right;">{{ $dish->description }}</p>
            <div class="price" style="text-align: right;">{{ $dish->price }} ر.س</div>
        
            <!-- زر الإضافة (أيقونة زائد) -->
            <i class="bi bi-plus-circle-fill position-absolute add-icon" style="bottom: 10px; left: 10px; font-size: 2.5rem; color: rgb(236, 181, 0); cursor: pointer;"></i>
        
            <!-- واجهة تحديد الكمية -->
             
            <div class="quantity-selector position-absolute d-none" style="bottom: 10px; left: 10px;">
                <button class="btn btn-sm btn-warning minus-btn"><i class="bi bi-dash" style="font-size: 30px; color: white;"></i></button>
                <span class="mx-2 quantity-count">1</span>
                <button class="btn btn-sm btn-warning plus-btn"><i class="bi bi-plus" style="font-size: 30px; color: white;"></i></button>
            </div>
        </div>
        
              
          @endforeach
      </div>

      <div class="row">
        <div class="col">
            <a href="#" onclick="submitOrder()" class="btn btn-lg btn-warning rounded-pill text-white checkout-btn" style="font-size: 1.2rem; text-decoration: none;">
                عرض تفاصيل الطلب 
                <i class="bi bi-arrow-left-circle-fill ms-2"></i>
            </a>      
        </div>
      </div>

      <form id="orderForm" method="POST" action="{{ route('Customer.placeOrder') }}">
        @csrf
        <input type="hidden" name="orderData" id="orderData">
      </form>

@endsection

<script>
document.addEventListener('DOMContentLoaded', function () {
    const menuCards = document.querySelectorAll('.menu-card');
    const orderForm = document.getElementById('orderForm');
    const orderDataInput = document.getElementById('orderData');
    const checkoutButton = document.querySelector('.checkout-btn');

    const dishes = [];

    menuCards.forEach(card => {
        const addIcon = card.querySelector('.add-icon');
        const quantitySelector = card.querySelector('.quantity-selector');
        const minusBtn = card.querySelector('.minus-btn');
        const plusBtn = card.querySelector('.plus-btn');
        const quantityCount = card.querySelector('.quantity-count');

        const dishId = card.getAttribute('data-dish-id');  // تأكد أنك تضيف data-dish-id="{{ $dish->id }}" في الكارد
        const dishName = card.querySelector('h3').textContent;
        const price = parseFloat(card.querySelector('.price').textContent);

        let quantity = 1;

        addIcon.addEventListener('click', () => {
    addIcon.classList.add('d-none');
    quantitySelector.classList.remove('d-none');
    updateDish(dishId, quantity, price); // نضيف الطبق مباشرة بكمية 1
});

        plusBtn.addEventListener('click', () => {
            quantity++;
            quantityCount.textContent = quantity;
            updateDish(dishId, quantity, price);
        });

        minusBtn.addEventListener('click', () => {
            if (quantity > 1) {
                quantity--;
                quantityCount.textContent = quantity;
                updateDish(dishId, quantity, price);
            } else {
                quantitySelector.classList.add('d-none');
                addIcon.classList.remove('d-none');
                removeDish(dishId);
            }
        });

        function updateDish(id, qty, unitPrice) {
            const index = dishes.findIndex(item => item.id === id);
            if (index > -1) {
                dishes[index].quantity = qty;
            } else {
                dishes.push({ id, quantity: qty, unit_price: unitPrice });
            }
        }

        function removeDish(id) {
            const index = dishes.findIndex(item => item.id === id);
            if (index > -1) {
                dishes.splice(index, 1);
            }
        }
    });

    document.querySelector('.checkout-btn')?.addEventListener('click', () => {
        orderDataInput.value = JSON.stringify(dishes);
        orderForm.submit();
    });
});
</script>


<style>
    .quantity-selector button {
        width: 32px;
        height: 32px;
        padding: 0;
        border-radius: 15px;
    }

    .quantity-selector span {
        font-weight: bold;
        min-width: 20px;
        display: inline-block;
        text-align: center;
    }
    
</style>
