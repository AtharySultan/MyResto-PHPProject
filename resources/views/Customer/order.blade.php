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
        <a href="{{ route('Customer.checkOut') }}" class="btn btn-lg btn-warning rounded-pill text-white checkout-btn" style="font-size: 1.2rem; text-decoration: none;">
    عرض تفاصيل الطلب 
    <i class="bi bi-arrow-left-circle-fill ms-2"></i>
</a>  
        </div>
      </div>



@endsection
<script>
document.addEventListener('DOMContentLoaded', function () {
    const menuCards = document.querySelectorAll('.menu-card');
    const checkoutButton = document.querySelector('.checkout-btn');
    const cartCount = document.querySelector('.cart-count');

    // تحميل السلة من localStorage إذا وجدت
    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    // دالة لتحديث عداد السلة
    const updateCartCount = () => {
        const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
        cartCount.textContent = totalItems;
        cartCount.style.display = totalItems > 0 ? 'inline-block' : 'none';
    };

    // دالة لتحديث حالة زر التشيك أوت
    const updateButtonVisibility = () => {
        checkoutButton.style.display = cart.length > 0 ? 'inline-block' : 'none';
    };

    // تحديث العداد وزر التشيك أوت عند التحميل
    updateCartCount();
    updateButtonVisibility();

    menuCards.forEach(card => {
        const addIcon = card.querySelector('.add-icon');
        const quantitySelector = card.querySelector('.quantity-selector');
        const minusBtn = card.querySelector('.minus-btn');
        const plusBtn = card.querySelector('.plus-btn');
        const quantityCount = card.querySelector('.quantity-count');

        const dishId = card.getAttribute('data-dish-id');
        const dishName = card.querySelector('h3').textContent;
        const price = parseFloat(card.querySelector('.price').textContent);

        // تحقق إذا كان الطبق موجودًا في السلة لإظهار الكمية
        const existingItem = cart.find(item => item.id === dishId);
        if (existingItem) {
            addIcon.classList.add('d-none');
            quantitySelector.classList.remove('d-none');
            quantityCount.textContent = existingItem.quantity;
        }

        let quantity = existingItem ? existingItem.quantity : 1;

        addIcon.addEventListener('click', () => {
            addIcon.classList.add('d-none');
            quantitySelector.classList.remove('d-none');
            quantityCount.textContent = quantity;
            updateCart(dishId, dishName, quantity, price);
        });

        plusBtn.addEventListener('click', () => {
            quantity++;
            quantityCount.textContent = quantity;
            updateCart(dishId, dishName, quantity, price);
        });

        minusBtn.addEventListener('click', () => {
            if (quantity > 1) {
                quantity--;
                quantityCount.textContent = quantity;
                updateCart(dishId, dishName, quantity, price);
            } else {
                quantitySelector.classList.add('d-none');
                addIcon.classList.remove('d-none');
                removeFromCart(dishId);
            }
        });

        function updateCart(id, name, qty, unitPrice) {
            const index = cart.findIndex(item => item.id === id);
            if (index > -1) {
                cart[index].quantity = qty;
            } else {
                cart.push({ id, name, quantity: qty, unit_price: unitPrice });
            }
            localStorage.setItem('cart', JSON.stringify(cart));
            updateCartCount();
            updateButtonVisibility();
        }

        function removeFromCart(id) {
            cart = cart.filter(item => item.id !== id);
            localStorage.setItem('cart', JSON.stringify(cart));
            updateCartCount();
            updateButtonVisibility();
        }
    });

    // تعديل زر التشيك أوت للانتقال إلى صفحة التشيك أوت
    checkoutButton.addEventListener('click', (e) => {
        e.preventDefault();
        window.location.href = "{{ route('Customer.checkOut') }}";
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
