<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" type="">

  <title>Resto</title>

  <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}" />
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css" integrity="sha512-CruCP+TD3yXzlvvijET8wV5WxxEh5H8P4cmz0RFbKK6FlZ2sYl3AEsKlLPHbniXKSrDdFewhbmBK5skbdsASbQ==" crossorigin="anonymous" />
  <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
  <link href="{{ asset('css/responsive.css') }}" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="{{ asset('CssCustom.css') }}">
</head>

<body>
  <div class="hero_area">
    <div class="bg-box">
      <img src="{{ asset('images/hero-bg.jpg') }}" alt="">
    </div>

    <header class="header_section">
      <div class="container">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
          <a class="navbar-brand" href="/">
            <span>Resto</span>
          </a>

          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class=""></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto">
              <li class="nav-item active">
                <a class="nav-link" href="/">الصفحة الرئيسية <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="menu">قائمة الطعام</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="BookTable">حجز طاولة</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="about">من نحن</a>
              </li>
            </ul>
            <div class="user_option d-flex align-items-center gap-3">
              @guest
                <a href="{{ route('login') }}" class="user_link" title="تسجيل الدخول">
                  <i class="fa fa-user" aria-hidden="true"></i>
                </a>
              @else
                <a href="{{ route('customer.profile') }}" class="user_link" title="الملف الشخصي">
                  <i class="fa fa-user" aria-hidden="true"></i>
                </a>
              @endguest

              <!-- أيقونة السلة -->

              <a class="cart_link position-relative" href="{{ route('Customer.checkOut') }}">
               <i class="bi bi-cart-fill cart-icon"></i>
              <span class="cart-count badge rounded-circle position-absolute" style="top: -12px; left: -12px; display: none;">0</span>
              </a>

              <!-- زر البحث -->
              <form class="form-inline" role="search">
                <button class="btn nav_search-btn" type="submit" title="بحث">
                  <i class="fa fa-search" aria-hidden="true"></i>
                </button>
              </form>

              <!-- زر الطلب -->
              <a href="{{ route('Customer.order') }}" class="order_online btn btn-success">
                اطلب اونلاين
              </a>
            </div>
          </div>
        </nav>
      </div>
    </header>

    <main>
      @yield('content')
    </main>

    <footer class="footer_section">
      <div class="container">
        <div class="row">
          <div class="col-md-4 footer-col">
            <div class="footer_contact">
              <h4>تواصل معانا</h4>
              <div class="contact_link_box">
                <a href="">
                  <i class="fa fa-map-marker" aria-hidden="true"></i>
                  <span>الموقع</span>
                </a>
                <a href="">
                  <i class="fa fa-phone" aria-hidden="true"></i>
                  <span>اتصل علينا +01 1234567890</span>
                </a>
                <a href="">
                  <i class="fa fa-envelope" aria-hidden="true"></i>
                  <span>demo@gmail.com</span>
                </a>
              </div>
            </div>
          </div>
          <div class="col-md-4 footer-col">
            <div class="footer_detail">
              <a href="" class="footer-logo">Resto</a>
              <p>تواصل معنا عبر حساباتنا على مواقع التواصل الاجتماعي للبقاء على اطلاع بكل جديد!</p>
              <div class="footer_social">
                <a href=""><i class="fa fa-facebook" aria-hidden="true"></i></a>
                <a href=""><i class="fa fa-twitter" aria-hidden="true"></i></a>
                <a href=""><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                <a href=""><i class="fa fa-instagram" aria-hidden="true"></i></a>
                <a href=""><i class="fa fa-pinterest" aria-hidden="true"></i></a>
              </div>
            </div>
          </div>
          <div class="col-md-4 footer-col">
            <h4>ساعات العمل</h4>
            <p>كل يوم</p>
            <p>10.00 Am -10.00 Pm</p>
          </div>
        </div>
      </div>
    </footer>

    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="js/bootstrap.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="https://unpkg.com/isotope-layout@3.0.4/dist/isotope.pkgd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js"></script>
    <script src="js/custom.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap"></script>
    <script src="/js/adminJS.js"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const cartCount = document.querySelector('.cart-count');
        const cart = JSON.parse(localStorage.getItem('cart')) || [];
        const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
        cartCount.textContent = totalItems;
        cartCount.style.display = totalItems > 0 ? 'block' : 'none';
    });
</script>

</body>

</html>