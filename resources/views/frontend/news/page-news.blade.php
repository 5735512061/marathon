@extends("frontend/layouts/template/template") 

@section("content")
<div class="legal-practice-area section-padding30">
    <div class="container">
        <div class="row ">
            <div class="col-xl-12">
                <div class="section-tittle text-center mb-70">
                    <h2>@lang('news.news')</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($news as $new => $value)
            <div class="col-xl-4 col-lg-4 col-md-6">
                <a href="{{url('/news-information')}}/{{$value->id}}">
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
                    <div class="single-practice mb-30">
                        <div class="practice-img">
                            <img src="{{url('/image_upload/image_news_main')}}/{{$value->image_main}}" class="img-responsive" width="100%;">
                        </div>
                        <div class="practice-caption">
                            @if(\Session::get('locale') == "th")
                                <p style="text-align: right;">{{$date_format_th}}</p>
                                <h2>{{$value->title}}</h2>
                                <h3>{!! $value->news !!}</h3>
                            @elseif(\Session::get('locale') == "en")
                                <p style="text-align: right;">{{$date_format_eng}}</p>
                                <h2>{{$value->title_eng}}</h2>
                                <h3>{!! $value->news_eng !!}</h3>
                            @else 
                                <p style="text-align: right;">{{$date_format_th}}</p>
                                <h2>{{$value->title}}</h2>
                                <h3>{!! $value->news !!}</h3>
                            @endif
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection