@extends('wadmin-dashboard::master')
@section('content')
    <ol class="breadcrumb breadcrumb-quirk">
        <li><a href="{{route('wadmin::dashboard.index.get')}}"><i class="fa fa-home mr5"></i> Dashboard</a></li>
        <li><a href="">Danh sách cảm nhận học viên</a></li>
    </ol>
    <div class="panel">
        <div class="panel-heading">
            <h4 class="panel-title">Danh sách cảm nhận học viên</h4>
            <p>Danh sách cảm nhận học viên trên trang</p>
        </div>

        <div class="search_page">
            <div class="panel-body">
                <div class="row">
                    <form method="get">
                        <div class="col-sm-5">
                            <input type="text" name="name" placeholder="Nhập tiêu đề" class="form-control">
                        </div>
                        <div class="col-sm-2">
                            <button type="submit" class="btn btn-info">Tìm kiếm</button>
                            <a href="{{route('wadmin::post.index.get',['post_type'=>'comment'])}}" class="btn btn-default">Làm lại</a>
                        </div>
                        <div class="col-sm-5">
                            <div class="button_more">
                                <a class="btn btn-primary" href="{{route('wadmin::comment.create.get',['post_type'=>'comment'])}}">Thêm mới</a>
                            </div>
                        </div>
                    </form>
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
                <table class="table nomargin">
                    <thead>
                    <tr>
                        <th>Hình ảnh</th>
                        <th>Tiêu đề</th>
                        <th>Người soạn</th>
                        <th>Lượt xem</th>
                        <th class="">Ngày tạo</th>
                        <th class="">Trạng thái</th>
                        <th class="">Nhân bản</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $d)
                        <tr>
                            <td>
                                <div class="product-img bg-transparent border">
                                    <img src="{{ ($d->thumbnail!='') ? upload_url($d->thumbnail) : public_url('admin/themes/images/no-image.png')}}" width="100" alt="">
                                </div>
                            </td>
                            <td>{{$d->name}}</td>
                            <td>{{$d->getUserPost->username}}</td>
                            <td>{{$d->count_view}}</td>
                            <td>{{format_date($d->created_at)}}</td>
                            <td>
                                @if($permissionPost->contains('name','status_active'))
                                    <a title="Click để duyệt bài nhanh hoặc ẩn bài viết" href="{{route('wadmin::page.change.get',$d->id)}}"
                                       class="btn btn-sm {{($d->status=='active') ? 'btn-success' : 'btn-warning'}} radius-30">
                                        {{($d->status=='active') ? 'Đang hiển thị' : 'Tạm ẩn'}}</a>
                                @else
                                    <a href="#"
                                       class="btn btn-sm {{($d->status=='active') ? 'btn-success' : 'btn-warning'}} radius-30">
                                        {{($d->status=='active') ? 'Đang hiển thị' : 'Tạm ẩn'}}</a>
                                @endif
                            </td>
                            <td>
                                <a href="{{route('wadmin::page.clone.get',$d->id)}}"
                                   class="btn btn-sm btn-info radius-30">Nhân bản</a>
                            </td>
                            <td>
                                <ul class="table-options">
                                    <li><a href="{{route('wadmin::page.edit.get',$d->id)}}"><i class="fa fa-pencil"></i></a></li>
                                    <li><a class="example-p-6" data-url="{{route('wadmin::page.remove.get',$d->id)}}"><i class="fa fa-trash"></i></a></li>
                                </ul>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
                {{$data->links()}}
            </div><!-- table-responsive -->
        </div>
    </div>
@endsection
