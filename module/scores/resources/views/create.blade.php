@extends('wadmin-dashboard::master')

@section('js')
    <script type="text/javascript" src="{{asset('admin/libs/ckeditor/ckeditor.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/libs/ckfinder/ckfinder_v1.js')}}"></script>
@endsection
@section('js-init')
    <script type="text/javascript">
        CKEDITOR.replace( 'editor1', {
            filebrowserBrowseUrl: '{{asset("admin/libs/ckfinder/ckfinder.html")}}',
            filebrowserImageBrowseUrl: '{{asset("admin/libs/ckfinder/ckfinder.html?type=Images")}}',
            filebrowserUploadUrl: '{{route('ckeditor.upload',['_token' => csrf_token() ])}}', //route dashboard/upload
            filebrowserUploadMethod: 'form'
        });
    </script>

@endsection

@section('content')

    <ol class="breadcrumb breadcrumb-quirk">
        <li><a href="{{route('wadmin::dashboard.index.get')}}"><i class="fa fa-home mr5"></i> Dashboard</a></li>
        <li><a href="{{route('wadmin::scores.index.get')}}">Danh sách điểm thi</a></li>
        <li class="active">Thêm điểm thi</li>
    </ol>

    <div class="row">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            <form method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="col-sm-8">
                    <div class="panel">
                        <div class="panel-heading">
                            <h4 class="panel-title">Thêm điểm thi</h4>
                            <p>Bạn cần nhập đầy đủ các thông tin để thêm điểm thi mới</p>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label>Họ tên thí sinh</label>
                                <input class="form-control"
                                       name="name"
                                       type="text"
                                       value="{{old('name')}}"
                                       placeholder="Ex : Nguyễn Văn A">
                            </div>
                            <div class="form-group">
                                <label>Số báo danh</label>
                                <input class="form-control"
                                       name="identification_number"
                                       type="text"
                                       value="{{old('identification_number')}}"
                                       placeholder="">
                            </div>
                            <div class="form-group">
                                <label>Số CCCD</label>
                                <input class="form-control" name="cccd_number" value="{{old('cccd_number')}}" type="text" placeholder="Nhập số căn cước công dân">
                            </div>
                            <div class="form-group">
                                <label>Ngày sinh</label>
                                <input class="form-control"
                                       name="birthday"
                                       type="text"
                                       value="{{old('birthday')}}"
                                       placeholder="VD: 15/07/2005">
                            </div>
                            <div class="form-group">
                                <label>Giới tính</label>
                                <select name="gender" class="form-control">
                                    <option value="Nam">Nam</option>
                                    <option value="Nữ" >Nữ</option>
                                    <option value="Khác">Khác</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Đối tượng dự thi</label>
                                <input class="form-control"
                                       name="test_subject"
                                       type="text"
                                       value="{{old('test_subject')}}"
                                       placeholder="VD : Thạc sỹ Y tế công cộng">
                            </div>

                            <div class="form-group">
                                <label>Năm tuyển sinh</label>
                                <input class="form-control"
                                       name="admission_year"
                                       type="text"
                                       value="{{old('admission_year',date('Y'))}}"
                                       placeholder="">
                            </div>
                            <div class="form-group">
                                <label>Ghi chú</label>
                                <textarea id="" name="comment" class="form-control" rows="3" placeholder="Ghi chú">{{old('comment')}}</textarea>
                            </div>

                            <div class="form-group">
                                <label>Tình trạng</label>
                                <select name="status" class="form-control">
                                    <option value="pending" >Thông báo điểm</option>
                                    <option value="approved" >Đỗ</option>
                                    <option value="reject" >Trượt</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <button class="btn btn-primary">Lưu lại</button>
                                <button class="btn btn-success" name="continue_post" value="1">Lưu và tiếp tục thêm</button>
                            </div>
                        </div>
                    </div><!-- panel -->

                </div><!-- col-sm-6 -->

                <!-- ####################################################### -->

                <div class="col-sm-4">
                    <div class="panel">
                        <div class="panel-heading">
                            <h4 class="panel-title">Tùy chọn thêm</h4>
                            <p>Thông tin các tùy chọn thêm </p>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label>Tên môn thi 1</label>
                                <input class="form-control"
                                       name="score_one_name"
                                       type="text"
                                       value="{{old('score_one_name')}}"
                                       placeholder="">
                            </div>
                            <div class="form-group">
                                <label>Điểm môn thi 1</label>
                                <input class="form-control"
                                       name="score_one"
                                       type="text"
                                       value="{{old('score_one')}}"
                                       placeholder="">
                            </div>
                            <div class="form-group">
                                <label>Điểm ưu tiên môn thi 1</label>
                                <input class="form-control"
                                       name="priority_score_one"
                                       type="text"
                                       value="{{old('priority_score_one')}}"
                                       placeholder="">
                            </div>
                            <div class="form-group">
                                <label>Tổng điểm môn thi 1</label>
                                <input class="form-control"
                                       name="total_score_one"
                                       type="text"
                                       value="{{old('total_score_one')}}"
                                       placeholder="">
                            </div>
                            <div class="form-group">
                                <label>Tên môn thi 2</label>
                                <input class="form-control"
                                       name="score_two_name"
                                       type="text"
                                       value="{{old('score_two_name')}}"
                                       placeholder="">
                            </div>
                            <div class="form-group">
                                <label>Điểm môn thi 2</label>
                                <input class="form-control"
                                       name="score_two"
                                       type="text"
                                       value="{{old('score_two')}}"
                                       placeholder="">
                            </div>
                            <div class="form-group">
                                <label>Điểm ưu tiên môn thi 2</label>
                                <input class="form-control"
                                       name="priority_score_two"
                                       type="number"
                                       value="{{old('priority_score_two')}}"
                                       placeholder="">
                            </div>
                            <div class="form-group">
                                <label>Tổng điểm môn thi 2</label>
                                <input class="form-control"
                                       name="total_score_two"
                                       type="text"
                                       value="{{old('total_score_two')}}"
                                       placeholder="">
                            </div>

                            <div class="form-group">
                                <label>Tổng điểm xét tuyển ( đã bao gồm điểm ưu tiên )</label>
                                <input class="form-control"
                                       name="total_scores"
                                       type="text"
                                       value="{{old('total_scores')}}"
                                       placeholder="">
                            </div>

                            <div class="form-group">
                                <button class="btn btn-primary">Lưu lại</button>
                                <button class="btn btn-success" name="continue_post" value="1">Lưu và tiếp tục thêm</button>
                            </div>

                        </div><!-- col-sm-6 -->
                    </div><!-- row -->

                </div>

            </form>
    </div>
@endsection
