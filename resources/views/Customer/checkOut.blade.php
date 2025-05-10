@extends('layouts.app')

@section('content')
<div class="profile-container py-5" dir="rtl">
    <div class="row">
        <div class="col-md-10 col-lg-8 mx-auto">
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-header bg-warning text-white text-center py-3 rounded-top">
                    <h4 class="mb-0">{{ ('فاتورة الطلب') }}</h4>
                </div>
                <div class="card-body p-4">
                    <h5 class="text-end mb-3">{{ ('اسم العميل') }}: {{ Auth::user()->name }}</h5>
                    <h5 class="text-end mb-3">{{ ('تفاصيل الطلب') }}</h5>
                    <table class="table table-hover">
                        <thead class="table-warning">
                            <tr>
                                <th>{{ ('الطبق') }}</th>
                                <th>{{ ('الكمية') }}</th>
                                <th>{{ ('السعر') }}</th>
                            </tr>
                        </thead>
                        <tbody id="cart-items">
                            <!-- سيتم ملء هذا الجدول ديناميكيًا باستخدام JavaScript -->
                        </tbody>
                        <tfoot>
                            <tr class="total-row">
                                <td colspan="2" class="text-end">{{ ('الإجمالي') }}:</td>
                                <td id="total-price">0.00 {{ ('ر.س') }}</td>
                            </tr>
                        </tfoot>
                    </table>

                    <form id="confirmOrderForm" action="{{ route('Customer.placeOrder') }}" method="POST">
                        @csrf
                        <input type="hidden" name="customer_name" value="{{ Auth::user()->name }}">
                        <input type="hidden" name="customer_email" value="{{ Auth::user()->email }}">
                        <input type="hidden" name="pickup_time" value="{{ now()->addHour()->toDateTimeString() }}">
                        <input type="hidden" name="total_price" id="form-total-price">
                        <input type="hidden" name="items" id="form-items">
                        <div class="text-end mt-4">
                            <button type="submit" class="btn btn-warning rounded-pill py-2 px-4">
                                {{ ('تأكيد الطلب') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const cartItemsTable = document.getElementById('cart-items');
    const totalPriceElement = document.getElementById('total-price');
    const formTotalPrice = document.getElementById('form-total-price');
    const formItems = document.getElementById('form-items');

    // تحميل السلة من localStorage
    const cart = JSON.parse(localStorage.getItem('cart')) || [];

    if (cart.length === 0) {
        cartItemsTable.innerHTML = '<tr><td colspan="3" class="text-center">السلة فارغة</td></tr>';
        return;
    }

    let total = 0;
    cart.forEach((item, index) => {
        const itemTotal = item.unit_price * item.quantity;
        total += itemTotal;

        const row = `
            <tr>
                <td>${item.name}</td>
                <td>${item.quantity}</td>
                <td>${itemTotal.toFixed(2)} ر.س</td>
            </tr>
        `;
        cartItemsTable.innerHTML += row;
    });

    // تحديث الإجمالي
    totalPriceElement.textContent = `${total.toFixed(2)} ر.س`;
    formTotalPrice.value = total.toFixed(2);

    // تحضير بيانات العناصر للنموذج
    const itemsForForm = cart.map(item => ({
        dish_id: item.id,
        quantity: item.quantity,
        unit_price: item.unit_price
    }));
    formItems.value = JSON.stringify(itemsForForm);

    // عند إرسال النموذج، امسح السلة
    document.getElementById('confirmOrderForm').addEventListener('submit', function () {
        localStorage.removeItem('cart');
    });
});
</script>

<style>
    .profile-container {
        text-align: right !important;
        padding: 3rem 1rem;
    }
    .profile-container .row {
        justify-content: flex-end !important;
    }
    .card {
        background: #fff;
        border-radius: 15px;
        overflow: hidden;
    }
    .card-header {
        border-bottom: none;
    }
    .table-warning {
        background-color: #ffc107;
        color: #fff;
    }
    .total-row {
        font-weight: bold;
        font-size: 1.2rem;
    }
    .btn-warning:hover {
        background-color: #e0a800;
        border-color: #d39e00;
    }
    .table-hover tbody tr:hover {
        background-color: #f1f1f1;
    }
</style>
@endsection