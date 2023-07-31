<style>
    
    .col-md-3 {
      padding-left: 5px !important;
      padding-right: 5px !important;
      max-width: 20% !important;
    }
    .clock-item {
        margin: 0px 5px 70px 14px;
      }
    .clock-item .inner {
      height: 0px;
      position: relative;
      width: 100%;
    }
    .clock-canvas {
      background-color: #ff5004;
      /* border-radius: 20%; */
      height: 0px;
      padding-bottom: 100%;
    }
    .text {
      color: #fff;
      font-size: 30px;
      font-weight: bold;
      position: absolute;
      top: 10px;
      text-align: center;
      width: 100%;
    }
    .text .val {
      font-size: 40px;
      margin-bottom: -10px !important;
    }
    .text .type-time {
      font-size: 14px;
    }
     @media (min-width: 768px) and (max-width: 991px) {
      .clock-item {
        margin-bottom: 30px;
      }

      .countdown {
        margin-right: -10rem !important;
        margin-left: -7rem !important;
      }
      .clock-item {
        margin: 0px 4px 79px 7px !important;
      }
    }
     @media (max-width: 767px) {
      .clock-item {
        margin: 9px -7px 80px 20px;
      }

      .countdown {
        margin-right: -15px !important;
      }
      
      .row-counter {
        flex-wrap: unset;
      }
    }
    .bg {
        background-color: red;
    }

    @media only screen and (min-width: 768px) and (max-width: 991px) {
      .image-logo-run {
        width: 350% !important;
      }
      #ipad {
        display: inline !important;
      }
    }

    @media (max-width: 767px) {
      #mobile {
        display: inline !important;
      }
  } 

</style>
@php
    $day = DB::table('counters')->where('status','เปิด')->orderBy('id','desc')->value('day');
    $month = DB::table('counters')->where('status','เปิด')->orderBy('id','desc')->value('month');
    $year = DB::table('counters')->where('status','เปิด')->orderBy('id','desc')->value('year');
    $time = DB::table('counters')->where('status','เปิด')->orderBy('id','desc')->value('time');
    $name = DB::table('counters')->where('status','เปิด')->orderBy('id','desc')->value('name');

    $js_lang = array(
        'day' => $day,
        'month' => $month,
        'year' => $year,
        'time' => $time
    );
@endphp


<header>
    <div class="header-area header-sticky">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-xl-2 col-lg-1 col-md-1">
                    <div class="logo">
                        @php
                            $logo = DB::table('image_logos')->where('status','เปิด')->value('image');
                        @endphp
                        <center><a href=""><img src="{{url('/image_upload/image_logo')}}/{{$logo}}" class="img-responsive image-logo-run" width="40%"></a></center>
                    </div>
                </div>
                <div class="col-xl-7 col-lg-8 col-md-6">
                    <div class="main-menu f-right d-none d-lg-block">
                        <nav>
                            <ul id="navigation">  
                                <li><a href="{{url('/')}}">@lang('index.home')</a></li>
                                <li><a href="{{url('/news')}}">@lang('index.news')</a></li>
                                <li><a href="{{url('/gallery')}}">@lang('index.gallery')</a></li>
                                <li><a href="{{url('/about-us')}}">@lang('index.about_us')</a></li>
                                <li><a href="{{url('/contact-us')}}">@lang('index.contact_us')</a></li>
                                <li>
                                    <a href="#">@lang('index.language')</a>
                                    <ul class="submenu">
                                        <li><a href="{{url('/locale/th')}}">ไทย</a></li>
                                        <li><a href="{{url('/locale/en')}}">English</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>           
                <div class="col-12">
                    <div class="mobile_menu d-block d-lg-none"></div>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="container" id="mobile"  style="display: none;">
  <div class="row" style="margin-bottom: -4rem !important;">
    <div class="col-4" style="margin-left:1rem;"></div>
    <div class="col-4">
      <div class="row">
        <div class="col-6" style="margin-right: 2rem;">
          <a href="{{url('/locale/th')}}"><img src="https://img.icons8.com/emoji/30/000000/thailand-emoji.png"/><p style="margin-left: 0.3rem; margin-top:-0.9rem; font-size:13px;">TH</p></a>
        </div>
        <div class="col-6" style="margin-left: -4rem;">
          <a href="{{url('/locale/en')}}"><img src="https://img.icons8.com/emoji/30/000000/united-kingdom-emoji.png"/><p style="margin-left: 0.1rem; margin-top:-0.9rem; font-size:13px;">ENG</p></a>
        </div>
      </div>
    </div>
    <div class="col-4"></div>
    {{-- <div class="col-6">
      <span class="fa fa-facebook-square" style="font-size:35px; color: #1877f2;"></span>
      <span class="fab fa-line" style="font-size:35px; color: #06c152;"></span>
      <span class="fa fa-phone-square" style="font-size:35px;"></span>
    </div> --}}
  </div>
</div>
<div class="container" id="ipad"  style="display: none;">
  <div class="row" style="margin-bottom: -4rem !important;">
    <div class="col-4" style="margin-left:5.6rem;"></div>
    <div class="col-4">
      <div class="row">
        <div class="col-6" style="margin-right: 1rem;">
          <a href="{{url('/locale/th')}}"><img src="https://img.icons8.com/emoji/30/000000/thailand-emoji.png"/><p style="margin-left: 0.3rem; margin-top:-0.9rem; font-size:13px;">TH</p></a>
        </div>
        <div class="col-6" style="margin-left: -7rem;">
          <a href="{{url('/locale/en')}}"><img src="https://img.icons8.com/emoji/30/000000/united-kingdom-emoji.png"/><p style="margin-left: 0.1rem; margin-top:-0.9rem; font-size:13px;">ENG</p></a>
        </div>
      </div>
    </div>
    <div class="col-4"></div>
    {{-- <div class="col-6">
      <span class="fa fa-facebook-square" style="font-size:35px; color: #1877f2;"></span>
      <span class="fab fa-line" style="font-size:35px; color: #06c152;"></span>
      <span class="fa fa-phone-square" style="font-size:35px;"></span>
    </div> --}}
  </div>
</div>

<script>  
    var js_lang = {!! json_encode($js_lang) !!};
    var date = js_lang.month+ " " +js_lang.day+ ","+" "+js_lang.year+" "+js_lang.time;
    
    // Set the date we're counting down to
    var countDownDate = new Date(date).getTime();
    
    // Update the count down every 1 second
    var x = setInterval(function() {
    
      // Get today's date and time
      var now = new Date().getTime();
        
      // Find the distance between now and the count down date
      var distance = countDownDate - now;
        
      // Time calculations for days, hours, minutes and seconds
      var days = Math.floor(distance / (1000 * 60 * 60 * 24));
      var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        
      // Output the result in an element with id="demo"
      document.getElementById("demo_day").innerHTML = days;
      document.getElementById("demo_hours").innerHTML = hours;
      document.getElementById("demo_minutes").innerHTML = minutes;
      document.getElementById("demo_seconds").innerHTML = seconds;
        
      // If the count down is over, write some text 
      if (distance < 0) {
        clearInterval(x);
        document.getElementById("demo").innerHTML = "EXPIRED";
      }
    }, 1000);
</script>