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
                            <input class="form-control" name="cccd_number" type="text" placeholder="Nhập số căn cước công dân">
                        </div>
                        <div class="form-group">
                            <label>Ngày sinh</label>
                            <input class="form-control"
                                   name="birthday"
                                   type="text"
                                   value="{{old('birthday')}}"
                                   placeholder="">
                        </div>
                        <div class="form-group">
                            <label>Giới tính</label>
                            <select name="gender" class="form-control">
                                <option value="Nam" {{(old('gender')=='Nam') ? 'selected' : ''}}>Nam</option>
                                <option value="Nữ" {{(old('gender')=='Nữ') ? 'selected' : ''}}>Nữ</option>
                                <option value="Khác" {{(old('gender')=='Khác') ? 'selected' : ''}}>Khác</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Đối tượng dự thi</label>
                            <input class="form-control"
                                   name="test_subject"
                                   type="text"
                                   value="{{old('test_subject')}}"
                                   placeholder="">
                        </div>
                        <div class="form-group">
                            <label>Mã ngành</label>
                            <input class="form-control"
                                   name="industry_code"
                                   type="text"
                                   value="{{old('industry_code')}}"
                                   placeholder="Mã ngành đăng ký tuyển sinh">
                        </div>
                        <div class="form-group">
                            <label>Năm tuyển sinh</label>
                            <input class="form-control"
                                   name="admission_year"
                                   type="number"
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
                                <option value="pending" {{(old('status')=='pending') ? 'selected' : ''}}>Thông báo điểm</option>
                                <option value="approved" {{(old('status')=='approved') ? 'selected' : ''}}>Đỗ</option>
                                <option value="reject" {{(old('status')=='reject') ? 'selected' : ''}}>Trượt</option>
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
                            <label>Điểm môn mới</label>
                            <input class="form-control"
                                   name="score_one"
                                   type="number"
                                   value="{{old('score_one',null)}}"
                                   placeholder="">
                        </div>
                        <div class="form-group">
                            <label>Điểm ưu tiên môn mới</label>
                            <input class="form-control"
                                   name="priority_score_one"
                                   type="number"
                                   value="{{old('priority_score_one',0)}}"
                                   placeholder="">
                        </div>
                        <div class="form-group">
                            <label>Điểm môn sinh</label>
                            <input class="form-control"
                                   name="biology_scores"
                                   type="number"
                                   value="{{old('biology_scores',0)}}"
                                   placeholder="">
                        </div>
                        <div class="form-group">
                            <label>Điểm ưu tiên môn sinh</label>
                            <input class="form-control"
                                   name="priority_biology_scores"
                                   type="number"
                                   value="{{old('priority_biology_scores',0)}}"
                                   placeholder="">
                        </div>
                        <div class="form-group">
                            <label>Điểm môn toán thống kê</label>
                            <input class="form-control"
                                   name="math_scores"
                                   type="number"
                                   value="{{old('math_scores',0)}}"
                                   placeholder="">
                        </div>
                        <div class="form-group">
                            <label>Điểm ưu tiên môn toán thống kê</label>
                            <input class="form-control"
                                   name="priority_math_scores"
                                   type="number"
                                   value="{{old('priority_math_scores',0)}}"
                                   placeholder="">
                        </div>
                        <div class="form-group">
                            <label>Điểm tiếng anh</label>
                            <input class="form-control"
                                   name="english_scores"
                                   type="number"
                                   value="{{old('english_scores',0)}}"
                                   placeholder="">
                        </div>
                        <div class="form-group">
                            <label>Điểm ưu tiên môn tiếng anh</label>
                            <input class="form-control"
                                   name="priority_english_scores"
                                   type="number"
                                   value="{{old('priority_english_scores',0)}}"
                                   placeholder="">
                        </div>
                        <div class="form-group">
                            <label>Điểm dịch tễ - SKMT</label>
                            <input class="form-control"
                                   name="epidemiological_scores"
                                   type="number"
                                   value="{{old('epidemiological_scores',0)}}"
                                   placeholder="">
                        </div>
                        <div class="form-group">
                            <label>Điểm ưu tiên dịch tễ - SKMT</label>
                            <input class="form-control"
                                   name="priority_epidemiological_scores"
                                   type="number"
                                   value="{{old('priority_epidemiological_scores',0)}}"
                                   placeholder="">
                        </div>
                        <div class="form-group">
                            <label>Điểm môn tổ chức QL Y tế</label>
                            <input class="form-control"
                                   name="health_management_scores"
                                   type="number"
                                   value="{{old('health_management_scores',0)}}"
                                   placeholder="">
                        </div>
                        <div class="form-group">
                            <label>Điểm ưu tiên môn tổ chức QL Y tế</label>
                            <input class="form-control"
                                   name="priority_health_management_scores"
                                   type="number"
                                   value="{{old('priority_health_management_scores',0)}}"
                                   placeholder="">
                        </div>
                        <div class="form-group">
                            <label>Điểm Vi sinh - Hóa sinh- Huyết học</label>
                            <input class="form-control"
                                   name="biochemistry_hematology_scores"
                                   type="number"
                                   value="{{old('biochemistry_hematology_scores',0)}}"
                                   placeholder="">
                        </div>
                        <div class="form-group">
                            <label>Điểm ưu tiên Vi sinh - Hóa sinh- Huyết học</label>
                            <input class="form-control"
                                   name="priority_biochemistry_hematology_scores"
                                   type="number"
                                   value="{{old('priority_biochemistry_hematology_scores',0)}}"
                                   placeholder="">
                        </div>
                        <div class="form-group">
                            <label>Điểm DD-ATTP</label>
                            <input class="form-control"
                                   name="food_safety_scores"
                                   type="number"
                                   value="{{old('food_safety_scores',0)}}"
                                   placeholder="">
                        </div>
                        <div class="form-group">
                            <label>Điểm ưu tiên DD-ATTP</label>
                            <input class="form-control"
                                   name="priority_food_safety_scores"
                                   type="number"
                                   value="{{old('priority_food_safety_scores',0)}}"
                                   placeholder="">
                        </div>
                        <div class="form-group">
                            <label>Tổng điểm xét tuyển ( đã bao gồm điểm ưu tiên )</label>
                            <input class="form-control"
                                   name="total_scores"
                                   type="number"
                                   value="{{old('total_scores',0)}}"
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
