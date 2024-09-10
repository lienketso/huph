@extends('wadmin-dashboard::master')
@section('content')
    <ol class="breadcrumb breadcrumb-quirk">
        <li><a href="{{route('wadmin::dashboard.index.get')}}"><i class="fa fa-home mr5"></i> Dashboard</a></li>
        <li><a href="">Danh sách điểm thi</a></li>
    </ol>
    <div class="panel">
        <div class="panel-heading">
            <h4 class="panel-title">Danh sách điểm thi</h4>
            <p>Danh sách điểm thi trên trang</p>
        </div>

        <div class="search_page">
            <div class="panel-body">
                <div class="row">
                    <form method="get">
                        <div class="col-sm-3">
                            <input type="text" name="name" placeholder="Tên hoặc số CCCD" class="form-control">
                        </div>
                        <div class="col-sm-3">
                            <button type="submit" class="btn btn-info">Tìm kiếm</button>
                            <a href="{{route('wadmin::scores.index.get')}}" class="btn btn-default">Làm lại</a>
                        </div>
                        <div class="col-sm-3">
                            <div class="button_more">
                                <a class="btn btn-primary" href="{{route('wadmin::scores.create.get')}}"><i class="fa fa-plus"></i>  Thêm mới</a>
                            </div>

                        </div>

                    </form>
                    <div class="col-sm-3">
                        <form action="{{route('wadmin::scores.import.post')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="file" class="form-control">
                            <br>
                            <button class="btn btn-success"><i class="fa fa-file-image-o"></i> Import Excel Data</button>
                            <a class="btn btn-warning" href="{{asset('admin/themes/File-import-default.xls')}}"><i class="fa fa-download"></i> File dữ liệu mẫu</a>
                        </form>
                    </div>
                </div>

            </div>
        </div>

        <div class="panel-body">
            <div class="table-responsive">
                @if (session('edit'))
                    <div class="alert alert-info">{{session('edit')}}</div>
                @endif
                @if (session('create'))
                    <div class="alert alert-success">{{session('create')}}</div>
                @endif
                @if (session('delete'))
                    <div class="alert alert-success">{{session('delete')}}</div>
                @endif
                    @if (session('error'))
                        <div class="alert alert-danger">{{session('error')}}</div>
                    @endif
                    <form method="POST" action="{{route('wadmin::score-delete-multiple.post')}}">
                        @csrf
                        <button type="submit" class="btnRemoveAll"><i class="fa fa-remove"></i> Xóa tùy chọn</button>
                        <a style="margin-left: 20px" href="{{route('wadmin::score-export-excel')}}" class="btnExport"><i class="fa fa-download"></i> Xuất dữ liệu ra Excel</a>
                        <table class="table nomargin">
                            <thead>
                            <tr>
                                <th> <input type="checkbox" id="checkAll"> chọn tất cả</th>
                                <th>Số báo danh</th>
                                <th>Họ tên</th>
                                <th>Số CCCD</th>
                                <th>Ngày sinh</th>
                                <th>Đối tượng dự thi</th>
                                <th class="">Tổng điểm</th>
                                <th>Ghi chú</th>
                                <th>Cấu hình</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $d)
                                <tr>
                                    <td><input type="checkbox" name="ids[]" value="{{ $d->id }}" class="record-checkbox"></td>
                                    <td>{{$d->identification_number}}</td>
                                    <td>{{$d->name}}</td>
                                    <td>{{$d->cccd_number}}</td>
                                    <td>{{$d->birthday}}</td>
                                    <td>{{$d->test_subject}}</td>
                                    <td>{{$d->total_scores}}</td>
                                    <td>{{$d->comment}}</td>
                                    <td>
                                        <ul class="table-options">
                                            <li><a class="" href="{{route('wadmin::scores.edit.get',$d->id)}}" title="Sửa điểm thi"><i class="fa fa-edit"></i></a></li>
                                            <li><a class="example-p-6" data-url="{{route('wadmin::scores.remove.get',$d->id)}}" title="Xóa điểm thi"><i class="fa fa-trash"></i></a></li>
                                        </ul>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </form>
                {{$data->links()}}
            </div><!-- table-responsive -->
        </div>
    </div>
@endsection
