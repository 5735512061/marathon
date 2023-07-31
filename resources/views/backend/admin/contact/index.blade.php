@extends("/backend/layouts/template/template")

@section("content")
<div class="row">

<div class="col-md-2"></div>
<div class="col-xl-8 order-xl-1">
    <div class="flash-message">
      @foreach (['danger', 'warning', 'success', 'info'] as $msg)
          @if(Session::has('alert-' . $msg))
              <p class="alertdesign alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
          @endif
      @endforeach
    </div>
    <div class="card">
      <div class="card-header">
        <div class="row align-items-center">
          <div class="col-8">
            <h3 class="mb-0">แก้ไขข้อมูลติดต่อ</h3>
          </div>
        </div>
      </div>
      <div class="card-body">
        <form action="{{url('/admin/create-contact')}}" method="POST" enctype="multipart/form-data" autocomplete="off">@csrf
          <div class="pl-lg-4">
            <div class="row">
              <div class="col-lg-6">
                  @if ($errors->has('phone'))
                    <span class="text-danger" style="font-size: 17px;">({{ $errors->first('phone') }})</span>
                  @endif
                  <div class="form-group">
                      <label class="form-control-label" for="input-username">เบอร์โทรศัพท์</label>
                      <input type="text" id="input-username" name="phone" class="form-control" value="{{$contact->phone}}">
                  </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6">
                  @if ($errors->has('facebook'))
                    <span class="text-danger" style="font-size: 17px;">({{ $errors->first('facebook') }})</span>
                  @endif
                  <div class="form-group">
                    <label class="form-control-label">Facebook</label>
                    <input type="text" id="input-username" name="facebook" class="form-control" value="{{$contact->facebook}}">
                  </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label">ลิ้งค์ Facebook (ถ้ามี)</label>
                  <input type="text" id="input-username" name="facebook_url" class="form-control" value="{{$contact->facebook_url}}">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6">
                  @if ($errors->has('youtube'))
                    <span class="text-danger" style="font-size: 17px;">({{ $errors->first('youtube') }})</span>
                  @endif
                  <div class="form-group">
                    <label class="form-control-label">Youtube</label>
                    <input type="text" id="input-username" name="youtube" class="form-control" value="{{$contact->youtube}}">
                  </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label">ลิ้งค์ YouTube (ถ้ามี)</label>
                  <input type="text" id="input-username" name="youtube_url" class="form-control" value="{{$contact->youtube_url}}">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6">
                  @if ($errors->has('ig'))
                    <span class="text-danger" style="font-size: 17px;">({{ $errors->first('ig') }})</span>
                  @endif
                  <div class="form-group">
                    <label class="form-control-label">IG</label>
                    <input type="text" id="input-username" name="ig" class="form-control" value="{{$contact->ig}}">
                  </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label">ลิ้งค์ IG (ถ้ามี)</label>
                  <input type="text" id="input-username" name="ig_url" class="form-control" value="{{$contact->ig_url}}">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6">
                  @if ($errors->has('twitter'))
                    <span class="text-danger" style="font-size: 17px;">({{ $errors->first('twitter') }})</span>
                  @endif
                  <div class="form-group">
                    <label class="form-control-label">twitter</label>
                    <input type="text" id="input-username" name="twitter" class="form-control" value="{{$contact->twitter}}">
                  </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label">ลิ้งค์ twitter (ถ้ามี)</label>
                  <input type="text" id="input-username" name="twitter_url" class="form-control" value="{{$contact->twitter_url}}">
                </div>
              </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                  @if ($errors->has('tiktok'))
                    <span class="text-danger" style="font-size: 17px;">({{ $errors->first('tiktok') }})</span>
                  @endif
                  <div class="form-group">
                    <label class="form-control-label">tiktok</label>
                    <input type="text" id="input-username" name="tiktok" class="form-control" value="{{$contact->tiktok}}">
                  </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label">ลิ้งค์ tiktok (ถ้ามี)</label>
                  <input type="text" id="input-username" name="tiktok_url" class="form-control" value="{{$contact->tiktok_url}}">
                </div>
              </div>
              <div class="col-md-3">
                  <input type="hidden" name="id" value="{{$contact->id}}">
                  <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection