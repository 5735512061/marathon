@extends("frontend/layouts/template/template") 

@section("content")
<div class="legal-practice-area section-padding30">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-lg-8 col-md-8">
                <div class=" text-center mb-70">
                    <h2 style="font-size: 40px;">
                        @if(\Session::get('locale') == "th")
                            {{$gallery->title}}
                        @elseif(\Session::get('locale') == "en")    
                            {{$gallery->title_eng}}
                        @else 
                            {{$gallery->title}}
                        @endif
                    </h2>
                </div>
                <div class="single-practice mb-30">
                    <div class="practice-img">
                        <img src="{{url('/image_upload/image_gallery_main')}}/{{$gallery->image_main}}" class="img-responsive" width="100%;">
                    </div>
                </div>
                @php
                    $image_multis = DB::table('gallery_image_multis')->where('gallery_id',$gallery->id)->get();
                @endphp
                <div class="row">
                    @foreach ($image_multis as $image_multi => $value)
                        <div class="col-md-4" style="margin-top: 20px;">
                            <img src="{{url('/image_upload/image_gallery_multi')}}/{{$value->image_multi}}" class="img-responsive" width="100%;">
                        </div>      
                    @endforeach
                </div>
                
            </div>
            <div class="col-xl-1 col-lg-1 col-md-12 col-12"></div>
            <div class="col-xl-3 col-lg-3 col-md-12 col-12">
                @php
                    $gallerys = DB::table('gallerys')->where('id','!=',$gallery->id)->paginate(5);
                @endphp
                <div style="background-color: #e4e4e4" class="mt-5">
                    @foreach ($gallerys as $gallery => $value)
                        <a href="{{url('/gallery-information')}}/{{$value->id}}">
                            <img src="{{url('/image_upload/image_gallery_main')}}/{{$value->image_main}}" class="img-responsive" width="100%;" style="padding:30px;">
                        </a>
                    @endforeach
                </div>  
            </div>
        </div>
    </div>
</div>
@endsection