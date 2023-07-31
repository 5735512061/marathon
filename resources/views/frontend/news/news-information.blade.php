@extends("frontend/layouts/template/template") 

@section("content")
<div class="legal-practice-area section-padding30">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-lg-8 col-md-8">
                <div class=" text-center mb-70">
                    <h2 style="font-size: 40px;">
                        @if(\Session::get('locale') == "th")
                            {{$news->title}}
                        @elseif(\Session::get('locale') == "en")
                            {{$news->title_eng}}
                        @else 
                            {{$news->title}}
                        @endif
                    </h2>
                </div>
                <div class="single-practice mb-30">
                    <div class="practice-img">
                        <img src="{{url('/image_upload/image_news_main')}}/{{$news->image_main}}" class="img-responsive" width="100%;">
                    </div>
                    <div class="practice-caption" style="background-color: #fff;">
                        @if(\Session::get('locale') == "th")
                            <p>{!! $news->news !!}</p>
                        @elseif(\Session::get('locale') == "en")
                            <p>{!! $news->news_eng !!}</p>
                        @else 
                            <p>{!! $news->news !!}</p>
                        @endif
                    </div>
                </div>
                @php
                    $image_multis = DB::table('news_image_multis')->where('news_id',$news->id)->get();
                @endphp
                <h4>@lang('news.image')</h4><hr>
                <div class="row">
                    @foreach ($image_multis as $image_multi => $value)
                        <div class="col-md-4" style="margin-top: 20px;">
                            <img src="{{url('/image_upload/image_news_multi')}}/{{$value->image_multi}}" class="img-responsive" width="100%;">
                        </div>      
                    @endforeach
                </div>
                
            </div>
            <div class="col-md-1"></div>
            <div class="col-xl-3 col-lg-3 col-md-12 col-12">
                @php
                    $news = DB::table('news')->where('id','!=',$news->id)->paginate(5);
                @endphp
                <div style="background-color: #e4e4e4" class="mt-5">
                    @foreach ($news as $new => $value)
                        <a href="{{url('/news-information')}}/{{$value->id}}">
                            <img src="{{url('/image_upload/image_news_main')}}/{{$value->image_main}}" class="img-responsive" width="100%;" style="padding:30px;">
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@endsection