@extends('layouts.app')

@section('content')

    <!-- slider section -->
<body class="index-page">
    <section class="slider_section">
      <div id="customCarousel1" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="container ">
              <div class="row">
                <div class="col-md-7 col-lg-6 ">
                  <div class="detail-box"dir="rtl" style="text-align: right;">
                    <h1>
                      Fast Food Restaurant
                    </h1>
                    <p>
                        نُقدم لك تجربة طعام مميزة تجمع بين الطعم الشهي والخدمة السريعة.
                        من الساندويتشات الساخنة إلى المقبلات المقرمشة، كل شيء محضّر بحب وجودة عالية.
                        سواء كنت على عجلة من أمرك أو تبحث عن وجبة لذيذة، نحن خيارك الأمثل. 
                    </p>
                    <div class="btn-box">
                      <a href="" class="btn1">
                        احجز طاولتك الأن
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item ">
            <div class="container ">
              <div class="row">
                <div class="col-md-7 col-lg-6 ">
                  <div class="detail-box">
                    <h1>
                        نكهات ترضي كل الأذواق
                    </h1>
                    <p>
                        من البرجر الكلاسيكي إلى الأطباق المبتكرة، نوفر لك تنوعًا يرضي جميع أفراد العائلة.
                        كل وجبة تُحضّر باستخدام مكونات طازجة وجودة لا تضاهى.
                    </p>
                    <div class="btn-box">
                      <a href="" class="btn1">
                       احجز طاولتك الان
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="container ">
              <div class="row">
                <div class="col-md-7 col-lg-6 ">
                  <div class="detail-box">
                    <h1>
                        أجواء مريحة وخدمة سريعة
                    </h1>
                    <p>
                        سواء كنت تأخذ وجبتك معك أو تستمتع بها في المكان، نضمن لك تجربة مريحة وخدمة ترضيك.
                        في مطعمنا، راحتك وجودة وجبتك أولويتنا.
                    </p>
                    <div class="btn-box">
                      <a href="" class="btn1">
                        احجز طاولتك الان
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="container">
          <ol class="carousel-indicators">
            <li data-target="#customCarousel1" data-slide-to="0" class="active"></li>
            <li data-target="#customCarousel1" data-slide-to="1"></li>
            <li data-target="#customCarousel1" data-slide-to="2"></li>
          </ol>
        </div>
      </div>

    </section>
    <!-- end slider section -->
  </div>

  <!-- offer section -->

  <section class="offer_section layout_padding-bottom">
    <div class="offer_container">
      <div class="container ">
        <div class="row">
          <div class="col-md-6  ">
            <div class="box ">
              <div class="img-box">
              <img src="{{ asset('storage/dishes_images/3FGnsUXrXpPPONXiFJA0KTf74Axhks1UMK36LTLR.jpg') }}" alt="">
              </div>
              <div class="detail-box">
                <h5>
                  بطاطس مقلية
                </h5>
                <h6>
                  <span>20%</span> Off
                </h6>
                <a href="{{route('Customer.order')}}">
                  اطلب الأن <i class="bi bi-cart-fill"></i>
                  </a>
                  
              </div>
            </div>
          </div>
          <div class="col-md-6  ">
            <div class="box ">
              <div class="img-box">
              <img src="{{ asset('storage/dishes_images/4olrj44vaZTGhf3emP3lvirBUupIklgkoCalRQU2.jpg') }}" alt="">
              </div>
              <div class="detail-box">
                <h5>
                  سلطة يونانية
                </h5>
                <h6>
                  <span>15%</span> Off
                </h6>
                <a href="{{route('Customer.order')}}">
                    اطلب الأن <i class="bi bi-cart-fill"></i>
                  </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end offer section -->

  <!-- food section -->
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

  <!-- end food section -->

  <!-- about section -->

  <section class="about_section layout_padding">
    <div class="container  ">

      <div class="row">
        <div class="col-md-6 ">
          <div class="img-box">
            <img src="images/about-img.png" alt="">
          </div>
        </div>
        <div class="col-md-6">
          <div class="detail-box" dir="rtl" style="text-align: right;">
            <div class="heading_container">
              <h2>
                من نحن
              </h2>
            </div>
            <p>
            في قلب المدينة، أنشأنا مطعمنا لنقدم لكم تجربة مختلفة في عالم الوجبات السريعة. لا نقدم الطعام فقط،  
            بل نمنحكم لحظات ممتعة في مكان أنيق يجمع بين الجودة، السرعة، والذوق الرفيع. نستخدم أجود المكونات،  
            ونُعد وجباتنا بعناية لنضمن لكم نكهة لا تُنسى. سواء كنت تبحث عن وجبة سريعة بطابع فاخر،  
            أو مكان مريح تقضي فيه وقتك، نحن هنا لنمنحك الأفضل دائمًا.
            </p>

            <a href="">
              عرض المزيد
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>


  <!-- end about section -->


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
</body>
  <!-- end book section -->
@endsection
