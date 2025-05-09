@extends('layouts.admin')

@section('content')
<div class="container mt-5">
  <div class="card shadow-sm rounded-lg">
    <div class="card-header bg-primary text-white">
      تفاصيل الحجز
    </div>
    <div class="card-body">
      <table class="table table-borderless">
        <tbody>
          <tr><th>الاسم:</th><td>{{ $booking->customer_name }}</td></tr>
          <tr><th>رقم الهاتف:</th><td>{{ $booking->customer_phone }}</td></tr>
          <tr><th>عدد الأشخاص:</th><td>{{ $booking->number_of_people }}</td></tr>
          <tr><th>التاريخ:</th><td>{{ $booking->reservation_date }}</td></tr>
          <tr><th>الوقت:</th><td>{{ $booking->reservation_time }}</td></tr>
        </tbody>
      </table>
    </div>
    <div class="card-footer text-end">
      <a href="{{ route('Dashboard.ManageBook') }}" class="btn btn-secondary">رجوع</a>
    </div>
  </div>
</div>
@endsection
