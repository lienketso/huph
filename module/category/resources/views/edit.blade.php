@extends('wadmin-dashboard::master')

@section('content')

    <ol class="breadcrumb breadcrumb-quirk">
        <li><a href="{{route('wadmin::dashboard.index.get')}}"><i class="fa fa-home mr5"></i> Dashboard</a></li>
        <li><a href="{{route('wadmin::category.index.get')}}">Danh mục</a></li>
        <li class="active">Sửa Danh mục</li>
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
                        <h4 class="panel-title">Sửa Danh mục</h4>
                        <p>Bạn cần nhập đầy đủ các thông tin để Sửa Danh mục </p>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label>Tên danh mục</label>
                            <input class="form-control"
                                   name="name"
                                   type="text"
                                   value="{{$data->name}}"
                                   placeholder="Nhập tên danh mục">
                        </div>
                        <div class="form-group">
                            <label>Url ( sử dụng khi các đường dẫn danh mục trùng nhau )</label>
                            <input class="form-control"
                                   name="slug"
                                   type="text"
                                   value="{{$data->slug}}"
                                   placeholder="VD : tieu-de-danh-muc">
                        </div>
                        <div class="form-group">
                            <label>Mô tả danh mục</label>
                            <textarea id="" name="description" class="form-control" rows="3" placeholder="Mô tả ngắn">{{$data->description}}</textarea>
                        </div>


                        <div class="form-group">
                            <label>Thẻ Meta title</label>
                            <input class="form-control"
                                   name="meta_title"
                                   type="text"
                                   value="{{$data->meta_title}}"
                                   placeholder="">
                        </div>
                        <div class="form-group">
                            <label>Thẻ meta description</label>
                            <textarea id="" name="meta_desc" class="form-control" rows="3" placeholder="Thẻ Meta description">{{$data->meta_desc}}</textarea>
                        </div>

                        <div class="form-group">
                            <label>Tags Name ( Cách nhau bởi dấu phẩy )</label>
                            <input class="form-control"
                                   name="meta_tags"
                                   type="text"
                                   value="{{$data->meta_tags}}"
                                   placeholder="Cách nhau bởi dấu phẩy">
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
                            <label>Loại danh mục </label>
                            <select id="" name="cat_type" class="form-control" style="width: 100%" data-placeholder="">
                                <option value="post" {{($data->cat_type=='post') ? 'selected' : ''}}>Tin tức (default)</option>
                                <option value="daotao" {{($data->cat_type=='daotao') ? 'selected' : ''}}>Ngành đào tạo</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Danh mục cha</label>
                            <select id="" name="parent" class="form-control" style="width: 100%" data-placeholder="">
                                <option value="0">--Là danh mục cha--</option>
                                {{$model->optionCategory(0,1,4,$data->parent,$data->id)}}
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Thứ tự ưu tiên</label>
                            <input class="form-control"
                                   name="sort_order"
                                   type="number"
                                   min="0"
                                   value="{{$data->sort_order}}"
                                   placeholder="">
                        </div>
                        <div class="form-group">
                            <label>Hiển thị</label>
                            <select id="" name="display" class="form-control" style="width: 100%" >
                                <option value="0" {{ ($data->display==0) ? 'selected' : ''}}>Không chọn</option>
                                <option value="1" {{ ($data->display==1) ? 'selected' : ''}}>Trang chủ</option>
                                <option value="2" {{ ($data->display==2) ? 'selected' : ''}}>Chân trang</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Trạng thái</label>
                            <select id="" name="status" class="form-control" style="width: 100%" data-placeholder="Trạng thái">
                                <option value="active" {{ ($data->status=='active') ? 'selected' : ''}}>Hiển thị</option>
                                <option value="disable" {{ ($data->status=='disable') ? 'selected' : ''}}>Tạm ẩn</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Ảnh danh mục</label>
                            <div class="input-group col-xs-12" style="display: flex">
                                <input type="text" name="thumbnail" value="{{$data->thumbnail}}" id="ckfinder-input-1" class="form-control file-upload-info" placeholder="Upload Image">
                                <span class="input-group-append">
								<button class="file-upload-browse btn btn-primary" id="ckfinder-popup-1"  type="button">Chọn ảnh</button>
							</span>
                            </div>
                            <div class="col-xs-12">
                                <img src="{{($data->thumbnail!='') ? upload_url($data->thumbnail) : public_url('admin/themes/images/no-image.png')}}" id="imgreview" style="width: 100px; padding: 10px 0;">
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Ảnh banner</label>
                            <div class="input-group col-xs-12" style="display: flex">
                                <input type="text" name="banner" value="{{$data->banner}}" id="ckfinder-input-2" class="form-control file-upload-info" placeholder="Upload Image">
                                <span class="input-group-append">
								<button class="file-upload-browse btn btn-primary" id="ckfinder-popup-2"  type="button">Chọn ảnh</button>
							</span>
                            </div>

                        </div>
                        <div class="form-group">
                            <label>Ảnh banner 1 (Nếu có)</label>
                            <div class="input-group col-xs-12" style="display: flex">
                                <input type="text" name="banner_1" value="{{$data->banner_1}}" id="ckfinder-input-3" class="form-control file-upload-info" placeholder="Upload Image">
                                <span class="input-group-append">
								<button class="file-upload-browse btn btn-primary" id="ckfinder-popup-3"  type="button">Chọn ảnh</button>
							</span>
                            </div>

                        </div>
                        <div class="form-group">
                            <label>Ảnh banner 2 (Nếu có)</label>
                            <div class="input-group col-xs-12" style="display: flex">
                                <input type="text" name="banner_2" value="{{$data->banner_2}}" id="ckfinder-input-4" class="form-control file-upload-info" placeholder="Upload Image">
                                <span class="input-group-append">
								<button class="file-upload-browse btn btn-primary" id="ckfinder-popup-4"  type="button">Chọn ảnh</button>
							</span>
                            </div>

                        </div>
                        <div class="form-group">
                            <label>Ảnh banner 3 (Nếu có)</label>
                            <div class="input-group col-xs-12" style="display: flex">
                                <input type="text" name="banner_3" value="{{$data->banner_3}}" id="ckfinder-input-5" class="form-control file-upload-info" placeholder="Upload Image">
                                <span class="input-group-append">
								<button class="file-upload-browse btn btn-primary" id="ckfinder-popup-5"  type="button">Chọn ảnh</button>
							</span>
                            </div>

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
