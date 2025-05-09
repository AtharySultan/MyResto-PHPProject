@extends('layouts.app')

@section('content')


  <div class="container mb-4">
    <div class="invoice-box">
      <h2 class="text-center mb-4">فاتورة الطلب</h2>

      <table class="table">
        <thead class="table-warning">
          <tr>
            <th>الطبق</th>
            <th>الكمية</th>
            <th>السعر</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($order->orderItems as $item)
              <tr>
                <td>{{ $item->dish->name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ $item->unit_price * $item->quantity }} ر.س</td>
              </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr class="total-row">
              <td colspan="2" class="text-end">الإجمالي:</td>
              <td>{{ $order->total_price }} ر.س</td>
            </tr>
          </tfoot>
      </table>

      <div class="text-center mt-4">
        <button class="btn btn-warning rounded-pill checkout-btn text-white">
          المتابعة إلى الدفع <i class="bi bi-arrow-left-circle-fill ms-2"></i>
        </button>
      </div>
    </div>
  </div>
  @endsection

  <style>
    .invoice-box {
      background: #fff;
      border-radius: 15px;
      padding: 30px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      margin-top: 50px;
    }
    .total-row {
      font-weight: bold;
      font-size: 1.2rem;
    }
    .checkout-btn {
      font-size: 1.2rem;
      padding: 10px 30px;
    }
  </style>
