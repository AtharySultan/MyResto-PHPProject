@extends('layouts.app')

@section('content')



  <!-- book section -->
  <section class="book_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2>
          احجز طاولتك
        </h2>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form_container">
            <form method="POST" action="{{ route('Dashboard.StoreReservation') }}">           
               @csrf
              <div>
                <input type="text" class="form-control" name="customer_name" placeholder="الأسم" required />
              </div>
              <div>
                <input type="text" class="form-control" name="customer_phone" placeholder="رقم الهاتف" required />
              </div>
              <div>
                <select name="reservation_time" class="form-control" required>
                  <option value="" disabled selected>اختر وقت الحجز</option>
                  <option value="16:00:00">4:00 مساءً</option>
                  <option value="16:30:00">4:30 مساءً</option>
                  <option value="17:00:00">5:00 مساءً</option>
                  <option value="17:30:00">5:30 مساءً</option>
                  <option value="18:00:00">6:00 مساءً</option>
                  <option value="18:30:00">6:30 مساءً</option>
                  <option value="19:00:00">7:00 مساءً</option>
                  <option value="19:30:00">7:30 مساءً</option>
                  <option value="20:00:00">8:00 مساءً</option>
                  <option value="20:30:00">8:30 مساءً</option>
                  <option value="21:00:00">9:00 مساءً</option>
                </select>
              </div>
              <div>
                <select class="form-control nice-select wide" name="number_of_people" required>
                  <option value="" disabled selected>كم عدد الأشخاص</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5 أشخاص فأكثر</option>
                </select>
              </div>
              <div>
                <input type="date" class="form-control" name="reservation_date" required>
              </div>
              <div class="btn_box">
                <button type="submit">تأكيد</button>
              </div>
            </form>
            
          </div>
        </div>
        <div class="col-md-6">
          <div class="map_container ">
            <div id="googleMap"></div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- end book section -->

@endsection
