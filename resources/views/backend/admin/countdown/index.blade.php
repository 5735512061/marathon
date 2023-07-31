@extends("/backend/layouts/template/template")

@section("content")

<h1>จัดการระบบนับเวลาถอยหลัง</h1><br>
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
        <a href="" type="button" data-toggle="modal" data-target="#modal-create-countdown" class="btn btn-primary">
          เพิ่มข้อมูลเวลานับถอยหลัง
        </a>
      </div>
      <div class="table-responsive">
        {{$countdowns->links()}}
        <table class="table align-items-center table-flush">
          <thead class="thead-light">
            <tr>
              <th scope="col">#</th>
              <th scope="col">ชื่อกิจกรรม</th>
              <th scope="col">วัน/เวลา ที่สิ้นสุด</th>
              <th scope="col">สถานะ</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($countdowns as $countdown => $value)
              <tr>
                <td>{{$NUM_PAGE*($page-1) + $countdown+1}}</td>
                <td>{{$value->name}}</td>
                <td>{{$value->month}} {{$value->day}} , {{$value->year}} {{$value->time}}</td>
                <td>{{$value->status}}</td>
                <td>
                  <a href="" type="button" data-toggle="modal" data-target="#modal-form{{$value->id}}" data-id="{{$value->id}}">
                    <i class="fa fa-pencil-square" style="color:blue; font-size:18px;"></i>
                  </a>
                  <a href="{{url('/admin/countdown-delete/')}}/{{$value->id}}" onclick="return confirm('Are you sure to delete ?')">
                    <i class="fa fa-trash" style="color:red; font-size:18px;"></i>
                  </a>
                </td>
              </tr>
              <!-- Modal -->
              <div class="modal fade" id="modal-create-countdown" tabindex="-1" role="dialog" aria-labelledby="Title" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">เพิ่มข้อมูลเวลานับถอยหลัง</h5>
                        </div>
                        <form action="{{url('/admin/create-countdown')}}" enctype="multipart/form-data" method="post">@csrf
                            <div class="modal-body">
                                <div class="col-md-12">
                                    <div class="form-group">
                                      <label>ชื่อกิจกรรม</label>
                                      @if ($errors->has('name'))
                                        <span class="text-danger" style="font-size: 17px;">({{ $errors->first('name') }})</span>
                                      @endif
                                      <input type="text" class="form-control form-control-alternative mitr" name="name">
                                    </div>
                                    <div class="form-group">
                                        <label>วันที่สิ้นสุด</label>
                                        @if ($errors->has('day'))
                                          <span class="text-danger" style="font-size: 17px;">({{ $errors->first('day') }})</span>
                                        @endif
                                        <input type="text" class="form-control form-control-alternative mitr" name="day">
                                    </div>
                                    <div class="form-group">
                                      <label>เดือน</label>
                                      <select class="form-control" name="month">
                                          <option value="January">มกราคม</option>
                                          <option value="February">กุมภาพันธ์</option>
                                          <option value="March">มีนาคม</option>
                                          <option value="April">เมษายน</option>
                                          <option value="May">พฤษภาคม</option>
                                          <option value="June">มิถุนายน</option>
                                          <option value="July">กรกฎาคม</option>
                                          <option value="August">สิงหาคม</option>
                                          <option value="September">กันยายน</option>
                                          <option value="October">ตุลาคม</option>
                                          <option value="November">พฤษจิกายน</option>
                                          <option value="December">ธันวาคม</option>
                                      </select>
                                    </div>
                                    <div class="form-group">
                                      <label>ปี ค.ศ.</label>
                                      @if ($errors->has('year'))
                                        <span class="text-danger" style="font-size: 17px;">({{ $errors->first('year') }})</span>
                                      @endif
                                      <input type="text" class="form-control form-control-alternative mitr" name="year">
                                    </div>
                                    <div class="form-group">
                                      <label>เวลา</label>
                                      @if ($errors->has('time'))
                                        <span class="text-danger" style="font-size: 17px;">({{ $errors->first('time') }})</span>
                                      @endif
                                      <input type="text" class="form-control form-control-alternative mitr" name="time" placeholder="ตัวอย่าง 08:00:00">
                                    </div>
                                    <div class="form-group">
                                        <label>สถานะ</label>
                                        <select class="form-control" name="status">
                                            <option value="เปิด">เปิด</option>
                                            <option value="ปิด">ปิด</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="admin_id" value="{{Auth::guard('admin')->id()}}">
                                <button type="submit" class="btn btn-primary">อัพเดตข้อมูล</button>
                                <button type="button" class="btn btn-secondary prompt" data-dismiss="modal">ปิด</button>
                            </div>
                        </form>
                    </div>
                </div>
              </div>
              <!-- Modal -->
              <div class="modal fade" id="modal-form{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="Title" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">แก้ไขเวลานับถอยหลัง</h5>
                        </div>
                        <form action="{{url('/admin/update-countdown')}}" enctype="multipart/form-data" method="post">@csrf
                          <div class="modal-body">
                              <div class="col-md-12">
                                  <div class="form-group">
                                    <label>ชื่อกิจกรรม</label>
                                    @if ($errors->has('name'))
                                      <span class="text-danger" style="font-size: 17px;">({{ $errors->first('name') }})</span>
                                    @endif
                                    <input type="text" class="form-control form-control-alternative mitr" name="name" value="{{$value->name}}">
                                  </div>
                                  <div class="form-group">
                                      <label>วันที่สิ้นสุด</label>
                                      @if ($errors->has('day'))
                                        <span class="text-danger" style="font-size: 17px;">({{ $errors->first('day') }})</span>
                                      @endif
                                      <input type="text" class="form-control form-control-alternative mitr" name="day" value="{{$value->day}}">
                                  </div>
                                  <div class="form-group">
                                    <label>เดือน</label>
                                    <select class="form-control" name="month">
                                        @php
                                            if($value->month == "January") $month = "มกราคม";
                                            if($value->month == "February") $month = "กุมภาพันธ์";
                                            if($value->month == "March") $month = "มีนาคม";
                                            if($value->month == "April") $month = "เมษายน";
                                            if($value->month == "May") $month = "พฤษภาคม";
                                            if($value->month == "June") $month = "มิถุนายน";
                                            if($value->month == "July") $month = "กรกฎาคม";
                                            if($value->month == "August") $month = "สิงหาคม";
                                            if($value->month == "September") $month = "กันยายน";
                                            if($value->month == "October") $month = "ตุลาคม";
                                            if($value->month == "November") $month = "พฤษจิกายน";
                                            if($value->month == "December") $month = "ธันวาคม";
                                        @endphp
                                        <option value="{{$value->month}}">{{$month}}</option>
                                        <option value="January">มกราคม</option>
                                        <option value="February">กุมภาพันธ์</option>
                                        <option value="March">มีนาคม</option>
                                        <option value="April">เมษายน</option>
                                        <option value="May">พฤษภาคม</option>
                                        <option value="June">มิถุนายน</option>
                                        <option value="July">กรกฎาคม</option>
                                        <option value="August">สิงหาคม</option>
                                        <option value="September">กันยายน</option>
                                        <option value="October">ตุลาคม</option>
                                        <option value="November">พฤษจิกายน</option>
                                        <option value="December">ธันวาคม</option>
                                    </select>
                                  </div>
                                  <div class="form-group">
                                    <label>ปี ค.ศ.</label>
                                    @if ($errors->has('year'))
                                      <span class="text-danger" style="font-size: 17px;">({{ $errors->first('year') }})</span>
                                    @endif
                                    <input type="text" class="form-control form-control-alternative mitr" name="year" value="{{$value->year}}">
                                  </div>
                                  <div class="form-group">
                                    <label>เวลา</label>
                                    @if ($errors->has('time'))
                                      <span class="text-danger" style="font-size: 17px;">({{ $errors->first('time') }})</span>
                                    @endif
                                    <input type="text" class="form-control form-control-alternative mitr" name="time" placeholder="ตัวอย่าง 08:00:00" value="{{$value->time}}">
                                  </div>
                                  <div class="form-group">
                                      <label>สถานะ</label>
                                      <select class="form-control" name="status">
                                          <option value="{{$value->status}}">{{$value->status}}</option>
                                          <option value="เปิด">เปิด</option>
                                          <option value="ปิด">ปิด</option>
                                      </select>
                                  </div>
                              </div>
                          </div>
                          <div class="modal-footer">
                              <input type="hidden" name="admin_id" value="{{Auth::guard('admin')->id()}}">
                              <input type="hidden" name="id" value="{{$value->id}}">
                              <button type="submit" class="btn btn-primary">อัพเดตข้อมูล</button>
                              <button type="button" class="btn btn-secondary prompt" data-dismiss="modal">ปิด</button>
                          </div>
                        </form>
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
