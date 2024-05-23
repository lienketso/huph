@extends('wadmin-dashboard::master')
@section('content')
    <ol class="breadcrumb breadcrumb-quirk">
        <li><a href="{{route('wadmin::dashboard.index.get')}}"><i class="fa fa-home mr5"></i> Dashboard</a></li>
        <li><a href="">Danh sách báo cáo</a></li>
    </ol>
    <div class="panel">
        <div class="panel-heading">
            <h4 class="panel-title">Danh sách bài post</h4>
            <p>Danh sách báo cáo bài post user <strong>{{$user->full_name}}</strong></p>
        </div>

        <div class="search_page">
            <div class="panel-body">
                <div class="row">
                    <form method="get">
                        <div class="col-sm-5">
                            <input type="text" name="name" placeholder="Tên hoặc email" class="form-control">
                        </div>
                        <div class="col-sm-2">
                            <button type="submit" class="btn btn-info">Tìm kiếm</button>
                            <a href="{{route('wadmin::reports.index.get')}}" class="btn btn-default">Làm lại</a>
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
                        <th>Danh mục</th>
                        <th>Ngày post</th>
                        <th>Lượt xem</th>
                        <th>Xem bài viết</th>
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
                            <td>
                                @if($d->categories()->exists())
                                    @foreach($d->categories as $c)
                                        <span>{{$c->name}}</span> |
                                    @endforeach
                                @endif
                            </td>
                            <td>{{format_date($d->created_at)}}</td>
                            <td><strong style="color: green">{{$d->count_view}}</strong></td>
                            <td><a class="view-post" href="{{route('frontend::blog.detail.get',$d->slug)}}" target="_blank"><i class="fa fa-eye"></i> Xem</a></td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
                {{$data->links()}}
            </div><!-- table-responsive -->
        </div>
    </div>
@endsection
