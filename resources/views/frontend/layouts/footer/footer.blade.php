<footer>
    @php
        $logo = DB::table('image_logos')->value('image');
        $phone = DB::table('contacts')->value('phone');
        $facebook = DB::table('contacts')->value('facebook');
    @endphp
    <div class="footer-area footer-bg footer-padding">
        <div class="container">
            <div class="single-footer-caption">
                <div class="footer-logo">
                    <center><a href=""><img src="{{url('/image_upload/image_logo')}}/{{$logo}}" class="img-responsive" width="20%"></a></center>
                </div>
            </div>
                <div style="color: #fff;">
                    <center>@lang('contact.contact') : {{$phone}}</center>
                    <center>Facebook :  {{$facebook}}</center>
                </div>
            </div>
        </div>
    </div>
</footer>