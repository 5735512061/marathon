@extends("/backend/layouts/template/template")

@section("content")

<h1>จัดการข้อมูลกิจกรรม</h1><br>
<div class="row">
  <div class="col-xl-12">
    <div class="flash-message">
      @foreach (['danger', 'warning', 'success', 'info'] as $msg)
          @if(Session::has('alert-' . $msg))
              <p class="alertdesign alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
          @endif
      @endforeach
    </div>
    <div class="card">
      <div class="card-header border-0"  style="padding-left: 0;">
          <a href="{{url('/admin/create-gallery')}}" class="btn btn-primary">เพิ่มข้อมูลกิจกรรม</a>
      </div>
      <div class="table-responsive">
        {{$gallerys->links()}}
        <table class="table align-items-center table-flush">
          <thead class="thead-light">
            <tr>
              <th scope="col">#</th>
              <th scope="col">วันที่</th>
              <th scope="col">หัวข้อกิจกรรม</th>
              <th scope="col">หัวข้อกิจกรรม (ภาษาอังกฤษ)</th>
              <th scope="col">รูปภาพหลัก</th>
              <th scope="col">รูปภาพอื่นๆ</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($gallerys as $gallery => $value)
              <tr>
                <td>{{$NUM_PAGE*($page-1) + $gallery+1}}</td>
                <td>{{$value->date}}</td>
                <td>{{$value->title}}</td>
                <td>{{$value->title_eng}}</td>
                <td>
                  <a href="" type="button" data-toggle="modal" data-target="#modal-image-main{{$value->id}}" data-id="{{$value->id}}">
                    <i class="fa fa-folder" style="color:blue; font-size:18px;"></i>
                  </a>
                </td>
                <td>
                  <a href="{{url('/admin/gallery-image-multi-information/')}}/{{$value->id}}">
                    <i class="fa fa-folder" style="color:blue; font-size:18px;"></i>
                  </a>
                </td>
                <td>
                  <a href="" type="button" data-toggle="modal" data-target="#modal-gallery-edit{{$value->id}}" data-id="{{$value->id}}">
                    <i class="fa fa-pencil-square" style="color:blue; font-size:18px;"></i>
                  </a>
                  <a href="{{url('/admin/gallery-delete/')}}/{{$value->id}}" onclick="return confirm('Are you sure to delete ?')">
                    <i class="fa fa-trash" style="color:red; font-size:18px;"></i>
                  </a>
                </td>
              </tr>
              <!-- Modal -->
              <div class="modal fade" id="modal-image-main{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="Title" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-body">
                          <div class="col-md-12">
                            <img src="{{url('/image_upload/image_gallery_main')}}/{{$value->image_main}}" class="img-responsive" width="100%;">
                          </div>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-secondary prompt" data-dismiss="modal">ปิด</button>
                      </div>
                    </div>
                </div>
              </div>
              <!-- Modal -->
              <div class="modal fade" id="modal-gallery-edit{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="Title" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-body">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLongTitle">แก้ไขข้อมูลกิจกรรม</h5>
                        </div>
                        <form action="{{url('/admin/update-gallery')}}" enctype="multipart/form-data" method="post">@csrf
                          <div class="pl-lg-4">
                            <div class="row">
                              <div class="col-lg-12">
                                  @if ($errors->has('title'))
                                    <span class="text-danger" style="font-size: 17px;">({{ $errors->first('title') }})</span>
                                  @endif
                                  <div class="form-group">
                                      <label class="form-control-label" for="input-username">หัวข้อกิจกรรม</label>
                                      <input name="title" type="text" id="input-username" class="form-control" value="{{$value->title}}">
                                  </div>
                              </div>
                              <div class="col-lg-12">
                                @if ($errors->has('title_eng'))
                                  <span class="text-danger" style="font-size: 17px;">({{ $errors->first('title_eng') }})</span>
                                @endif
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username">หัวข้อกิจกรรม (ภาษาอังกฤษ)</label>
                                    <input name="title_eng" type="text" id="input-username" class="form-control" value="{{$value->title_eng}}">
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-lg-12">
                                @if ($errors->has('date'))
                                  <span class="text-danger" style="font-size: 17px;">({{ $errors->first('date') }})</span>
                                @endif
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username">วัน/เดือน/ปี</label>
                                    <input name="date" type="text" id="input-username" class="form-control" value="{{$value->date}}">
                                </div>
                              </div>
                              <div class="col-lg-12">
                                  <div class="form-group">
                                      <label class="form-control-label">รูปภาพปกหลัก ขนาดรูปภาพ 378*300 pixel</label>
                                      <input type="file" class="form-control form-control-alternative mitr" name="image_main">
                                  </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-12">
                                  <input type="hidden" name="admin_id" value="{{Auth::user()->id}}">
                                  <input type="hidden" name="id" value="{{$value->id}}">
                                  <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
                              </div>
                            </div>
                          </div>
                        </form>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-secondary prompt" data-dismiss="modal">ปิด</button>
                      </div>
                    </div>
                </div>
              </div>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

@endsection
