<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Google Search -->
  <meta name="google-site-verification" content="1PaYB4dlqRjhgBy-jyq5O89I4a8BzAc3d1E_s1BXLPs" />
  <link rel="icon" type="image/png" href="images/web/favicon.png">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta content="telephone=no" name="format-detection">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <base href="{{asset('')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="{{asset('assets/css/styles.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/flex-slider.css')}}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="{{asset('assets/css/owl.css')}}" rel="stylesheet">
    
</head>
<body>
    {{-- <div id="js-preloader" class="js-preloader">
        <div class="preloader-inner">
          <span class="dot"></span>
          <div class="dots">
            <span></span>
            <span></span>
            <span></span>
          </div>
        </div>
      </div> --}}
      @include('web.layouts.header')
      @yield('content')
      @include('web.layouts.footer')
      <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
      <script src="https://npmcdn.com/flatpickr/dist/l10n/vn.js"></script>
      <script src="http://127.0.0.1:8000/assets/js/owl-carousel.js"></script>
      <script src="http://127.0.0.1:8000/assets/js/tabs.js"></script>
      <script src="http://127.0.0.1:8000/assets/js/popup.js"></script>
      <script src="http://127.0.0.1:8000/assets/js/main.js"></script>
      <script>
        $(document).ready(function() {
          const activeLink = localStorage.getItem('activeLink');
          if (activeLink) {
            $('.nav li .nav_link').removeClass('active');
            $(`.nav li .nav_link[href="${activeLink}"]`).addClass('active');
          } else {
            $('.nav li .nav_link[href="/home"]').addClass('active');
          }

          $('.nav li .nav_link').click(function() {
            const href = $(this).attr('href');
            localStorage.setItem('activeLink', href);
            $('.nav li .nav_link').removeClass('active');
            $(this).addClass('active');
          });
        });
      </script>
      
      @yield('js')
</body>
</html>