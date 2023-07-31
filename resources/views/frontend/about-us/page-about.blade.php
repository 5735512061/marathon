@extends("frontend/layouts/template/template") 

@section("content")
{{-- <div class="slider-area ">
    <div class="single-slider slider-height2 d-flex align-items-center" data-background="{{ asset('frontend/assets/img/hero/law_hero2.jpg')}}">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="hero-cap text-center">
                        <h2>@lang('about.about_us')</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}

<div class="about-low-area about-bg about-padding" style="margin-top: -4rem;">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <center><div class="section-tittle section-tittle-l mb-70 mt-80">
                    <h2>@lang('about.phangnga_marathon')</h2>
                </div></center>
                <div class="about-caption mb-100">
                    <p style="font-size: 20px;">@lang('about.paragraph_1')</p>
                    <p style="font-size: 20px;">@lang('about.paragraph_2')</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection