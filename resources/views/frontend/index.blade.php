@extends("frontend/layouts/template/template") 
<link href="{{ asset('frontend/carousel/css/style.css')}}" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">
<style>
    @import url('https://fonts.googleapis.com/css2?family=Anton&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Barlow:wght@800&display=swap');
    @media only screen and (min-width: 768px) and (max-width: 991px) {
      .countdown-h1 {
        font-size: 2rem !important;
      }
    }
</style>
@section("content")
@php
    $image = DB::table('image_slides')->where('status','เปิด')->value('image');
    $slides = DB::table('image_slides')->where('status','เปิด')->where('image','!=',$image)->get();
    $name = DB::table('counters')->where('status','เปิด')->orderBy('id','desc')->value('name');
@endphp

<div class="section" id="carousel">
    <div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4" style="margin-top:2rem;">
                <center><h1 class="countdown-h1" style="font-size: 3.0rem; font-family: 'Anton', sans-serif;">COUNTDOWN TO {{$name}}</h1></center>
                <div class="countdown row" style="flex-wrap:nowrap;">
                <!-- days --> 
                <div class="clock-item col-md-3">
                    <div class="inner">
                        <div id="canvas_days" class="clock-canvas"></div>
                        <div class="text">
                            <p class="val" id="demo_day" style="padding-top: 1px !important; font-family: 'Barlow', sans-serif;"></p>
                            <p class="type-days type-time" style="padding-top: 10px !important;">DAYS</p>
                        </div>
                    </div>
                </div>
                
                <!-- hours --> 
                
                <div class="clock-item col-md-3">
                    <div class="inner">
                        <div id="canvas_hours" class="clock-canvas"></div>
                        <div class="text">
                            <p class="val" id="demo_hours" style="padding-top: 1px !important; font-family: 'Barlow', sans-serif;"></p>
                            <p class="type-days type-time" style="padding-top: 10px !important;">HOURS</p>
                        </div>
                    </div>
                </div>
                
                <!-- minutes --> 
                <div class="clock-item col-md-3">
                    <div class="inner">
                        <div id="canvas_minutes" class="clock-canvas"></div>
                        <div class="text">
                            <p class="val" id="demo_minutes" style="padding-top: 1px !important; font-family: 'Barlow', sans-serif;"></p>
                            <p class="type-days type-time" style="padding-top: 10px !important;">MINUTES</p>
                        </div>
                    </div>
                </div>
                
                <!-- seconds --> 
                <div class="clock-item col-md-3">
                    <div class="inner">
                        <div id="canvas_seconds" class="clock-canvas"></div>
                        <div class="text">
                            <p class="val" id="demo_seconds" style="padding-top: 1px !important; font-family: 'Barlow', sans-serif;"></p>
                            <p class="type-days type-time" style="padding-top: 10px !important;">SECONDS</p>
                        </div>
                    </div>
                </div>

                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
        <div class="row">
            <div class="col-md-12 col-12">
                <!-- Carousel Card -->
                <div class="card card-raised card-carousel">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="3000">
                      <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        @foreach ($slides as $slide => $value)
                            <li data-target="#carouselExampleIndicators" data-slide-to="{{$value->id}}" class=""></li>
                        @endforeach
                      </ol>
                      <div class="carousel-inner">
                        <div class="carousel-item active">
                          <img class="d-block w-100" src="{{ asset('/image_upload/image_slide')}}/{{$image}}">
                        </div>
                        @foreach ($slides as $slide => $value)
                            <div class="carousel-item">
                                <img class="d-block w-100" src="{{ asset('/image_upload/image_slide')}}/{{$value->image}}">
                            </div>
                        @endforeach
                      </div>
                      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <i class="material-icons">keyboard_arrow_left</i>
                        <span class="sr-only">Previous</span>
                      </a>
                      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <i class="material-icons">keyboard_arrow_right</i>
                        <span class="sr-only">Next</span>
                      </a>
                    </div>
                </div>
                <!-- End Carousel Card -->
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-6 col-12 mt-2">
            <a href="https://race.thai.run/phangngamarathonvirtual" target="_blank"><img src="{{url('/frontend/image/register_1.png')}}" class="img-responsive" width="100%;"></a>
        </div>
        <div class="col-md-6 col-12 mt-2">
            <a href="https://race.thai.run/phangngamarathon" target="_blank"><img src="{{url('/frontend/image/register_2.png')}}" class="img-responsive" width="100%;"></a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mt-5"> 
            <iframe width="560" height="315" src="https://www.youtube.com/embed/kkIabnfvJI8" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
        <div class="col-md-6 mt-5"> 
            <iframe width="560" height="315" src="https://www.youtube.com/embed/kkIabnfvJI8" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
    </div>
</div>

<!-- Legal Practice Area start -->
<div class="legal-practice-area section-padding30">
    <div class="container">
          <!--Section Tittle  -->
        <div class="row ">
            <div class="col-xl-12">
                <div class="section-tittle text-center mb-50">
                    <h2>@lang('index.news')</h2>
                </div>
            </div>
        </div>
        <!-- single items -->
        <div class="row">
            @foreach ($news as $new => $value)
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <a href="{{url('/news-information')}}/{{$value->id}}">
                        <div class="single-practice mb-30">
                            <div class="practice-img">
                                <img src="{{url('/image_upload/image_news_main')}}/{{$value->image_main}}" class="img-responsive" width="100%;">
                            </div>
                            <div class="practice-caption">
                                <?php
                                    $day = date_format(date_create_from_format('d/m/Y',$value->date),'d');
                                    $month = date_format(date_create_from_format('d/m/Y',$value->date),'m');
                                    $year = date_format(date_create_from_format('d/m/Y',$value->date),'Y');
                                    $year_ks = $year-543;

                                    $date_eng = $day."/".$month."/".$year_ks;
                                    $date_th = $year_ks."-".$month."-".$day;

                                    $date_format_eng = date_format(date_create_from_format('d/m/Y',$date_eng),'F d, Y');
                                    $date_format_th = thaidate('F j, Y', $date_th);
                                ?>
                                @if(\Session::get('locale') == "th")
                                    <p style="text-align: right;">{{$date_format_th}}</p>
                                    <h2>{{$value->title}}</h2>
                                    <h3 class="ellipsis-verti">{!! $value->news !!}</h3>
                                @elseif(\Session::get('locale') == "en")
                                    <p style="text-align: right;">{{$date_format_eng}}</p>
                                    <h2>{{$value->title_eng}}</h2>
                                    <h3 class="ellipsis-verti">{!! $value->news_eng !!}</h3>
                                @else 
                                    <p style="text-align: right;">{{$date_format_th}}</p>
                                    <h2>{{$value->title}}</h2>
                                    <h3 class="ellipsis-verti">{!! $value->news !!}</h3>
                                @endif
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        <center><p style="font-size:20px;"><a href="{{url('/news')}}" style="color:#000; border-bottom: 5px solid blue;">@lang('index.see_more')</a></p></center>
    </div>
</div>
<!-- Legal Practice Area End-->

<!-- About Law Start-->
<div class="legal-practice-area about-low-area about-bg about-padding">
    <div class="container">
        <!--Section Tittle  -->
      <div class="row ">
          <div class="col-xl-12">
              <div class="section-tittle text-center mb-70">
                  <h2>@lang('index.gallery')</h2>
              </div>
          </div>
      </div>
      <!-- single items -->
        <div class="row">
            @foreach ($gallerys as $gallery => $value)
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <a href="{{url('/gallery-information')}}/{{$value->id}}">
                        <div class="single-practice mb-30">
                            <div class="practice-img">
                                <img src="{{url('/image_upload/image_gallery_main')}}/{{$value->image_main}}" class="img-responsive" width="100%;">
                            </div>
                            <?php
                                $day = date_format(date_create_from_format('d/m/Y',$value->date),'d');
                                $month = date_format(date_create_from_format('d/m/Y',$value->date),'m');
                                $year = date_format(date_create_from_format('d/m/Y',$value->date),'Y');
                                $year_ks = $year-543;

                                $date_eng = $day."/".$month."/".$year_ks;
                                $date_th = $year_ks."-".$month."-".$day;

                                $date_format_eng = date_format(date_create_from_format('d/m/Y',$date_eng),'F d, Y');
                                $date_format_th = thaidate('F j, Y', $date_th);
                            ?>
                            <div class="practice-caption">
                                @if(\Session::get('locale') == "th")
                                    <h3>{{$value->title}}</h3>
                                    <p style="text-align: right;">{{$date_format_th}}</p>
                                @elseif(\Session::get('locale') == "en")
                                    <h3>{{$value->title_eng}}</h3>
                                    <p style="text-align: right;">{{$date_format_eng}}</p>
                                @else 
                                    <h3>{{$value->title}}</h3>
                                    <p style="text-align: right;">{{$date_format_th}}</p>
                                @endif
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        <center><p style="font-size:20px;"><a href="{{url('/gallery')}}" style="color:#000; border-bottom: 5px solid blue;">@lang('index.see_more')</a></p></center>
    </div>
</div>
{{-- carousel --}}
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://unpkg.com/popper.js@1.12.6/dist/umd/popper.js"></script>
<script src="https://unpkg.com/bootstrap-material-design@4.1.1/dist/js/bootstrap-material-design.js"></script>
@endsection