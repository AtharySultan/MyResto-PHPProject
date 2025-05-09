@extends('layouts.admin')

@section('content')
<div class="container mt-5">
  <h2 class="text-center mb-4" style="color:#191c24;">جميع الحجوزات الحالية</h2>
  <div class="row">
    @foreach($bookings as $booking)
      <div class="col-md-4">
        <div class="card mb-4 shadow-sm border-0 rounded-3 overflow-hidden" style="background-color:#191c24 !important;">
          
          <!-- النصف العلوي -->
          <div class=" text-white text-center py-4">
            <i class="bi bi-person-circle" style="font-size: 3rem;"></i>
            <h5 class="mt-2">{{ $booking->customer_name }}</h5>
          </div>

          <!-- النصف السفلي -->
          <div class="card-body " style="background-color: rgb(255, 255, 255)">
            <p class="card-text"><strong>رقم الجوال:</strong> {{ $booking->customer_phone }}</p>
            <p class="card-text"><strong>عدد الأشخاص:</strong> {{ $booking->number_of_people }}</p>
            <p class="card-text"><strong>التاريخ:</strong> {{ $booking->reservation_date }}</p>
            <p class="card-text"><strong>الوقت:</strong> {{ $booking->reservation_time }}</p>
            <a href="{{ route('Dashboard.ShowBookingDetails', $booking->id) }}" class="btn  d-block mx-auto mt-3 rounded-pill" style="width: fit-content; background-color: #ffc107; color: #191c24;">عرض التفاصيل</a>
          </div>
          
        </div>
      </div>
    @endforeach
  </div>
</div>
@endsection
