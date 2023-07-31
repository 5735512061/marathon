@extends("frontend/layouts/template/template") 

@section("content")
{{-- <div class="slider-area ">
    <div class="single-slider slider-height2 d-flex align-items-center" data-background="{{ asset('frontend/assets/img/hero/law_hero2.jpg')}}">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="hero-cap text-center">
                        <h2>@lang('contact.contact_us')</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}

<div class="about-low-area about-bg" style="margin-top: -4rem;">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <center>
                    <div class="section-tittle section-tittle-l mb-70 mt-80">
                        <h2>@lang('contact.social_media')</h2>
                    </div>
                </center>
                <div class="row mbr-justify-content-center">
                    <div class="col-lg-6 mbr-col-md-10">
                        <a href="{{$contact->facebook_url}}" target="_blank">
                            <div class="wrap">
                                <div class="ico-wrap">
                                    <span class="mbr-iconfont fa-facebook-square fa" style="color: #1877f2;"></span>
                                </div>
                                <div class="text-wrap vcenter">
                                    <h2 class="mbr-fonts-style mbr-bold mbr-section-title3 display-5">Facebook</h2>
                                    <p class="mbr-fonts-style text1 mbr-text display-6">{{$contact->facebook}}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-6 mbr-col-md-10">
                        <a href="{{$contact->line_url}}" target="_blank">
                            <div class="wrap">
                                <div class="ico-wrap">
                                    <span class="mbr-iconfont fab fa-line" style="color: #06c152;"></span>
                                </div>
                                <div class="text-wrap vcenter">
                                    <h2 class="mbr-fonts-style mbr-bold mbr-section-title3 display-5">Line</h2>
                                    <p class="mbr-fonts-style text1 mbr-text display-6">{{$contact->line}}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-6 mbr-col-md-10">
                        <a href="{{$contact->youtube_url}}" target="_blank">
                            <div class="wrap">
                                <div class="ico-wrap">
                                    <span class="mbr-iconfont fa-youtube fa" style="color: #f70000;"></span>
                                </div>
                                <div class="text-wrap vcenter">
                                    <h2 class="mbr-fonts-style mbr-bold mbr-section-title3 display-5">YouTube</h2>
                                    <p class="mbr-fonts-style text1 mbr-text display-6">{{$contact->youtube}}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-6 mbr-col-md-10">
                        <a href="{{$contact->ig_url}}" target="_blank">
                            <div class="wrap">
                                <div class="ico-wrap">
                                    <span class="mbr-iconfont fa-instagram fa" style="color: #c8298a;"></span>
                                </div>
                                <div class="text-wrap vcenter">
                                    <h2 class="mbr-fonts-style mbr-bold mbr-section-title3 display-5">IG</h2>
                                    <p class="mbr-fonts-style text1 mbr-text display-6">{{$contact->ig}}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-6 mbr-col-md-10">
                        <a href="{{$contact->twitter_url}}" target="_blank">
                            <div class="wrap">
                                <div class="ico-wrap">
                                    <span class="mbr-iconfont fa-twitter fa" style="color: #1c9cea;"></span>
                                </div>
                                <div class="text-wrap vcenter">
                                    <h2 class="mbr-fonts-style mbr-bold mbr-section-title3 display-5">twitter</h2>
                                    <p class="mbr-fonts-style text1 mbr-text display-6">{{$contact->twitter}}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-6 mbr-col-md-10">
                        <a href="{{$contact->tiktok_url}}" target="_blank">
                            <div class="wrap">
                                <div class="ico-wrap">
                                    <span class="mbr-iconfont fa-chain-broken fa"></span>
                                </div>
                                <div class="text-wrap vcenter">
                                    <h2 class="mbr-fonts-style mbr-bold mbr-section-title3 display-5">TikTok</h2>
                                    <p class="mbr-fonts-style text1 mbr-text display-6">{{$contact->tiktok}}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection