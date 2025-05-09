@extends('wadmin-dashboard::master')

@section('js')
    <script type="text/javascript" src="{{asset('admin/libs/ckeditor/ckeditor.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/libs/ckfinder/ckfinder.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/js/post.js')}}"></script>
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

    <script type="text/javascript">
        function downloadSVG() {
            const svg = document.getElementById('svgID').innerHTML;
            const blob = new Blob([svg.toString()]);
            const element = document.createElement("a");
            element.download = "QR-{!! $data->slug !!}.svg";
            element.href = window.URL.createObjectURL(blob);
            element.click();
            element.remove();
        }
    </script>

    <script type="text/javascript">
        function removeVietnameseTones(str) {
            str = str.normalize('NFD').replace(/[\u0300-\u036f]/g, "");
            str = str.replace(/đ/g, 'd').replace(/Đ/g, 'D');
            return str;
        }
        function generateSlug(str) {
            str = removeVietnameseTones(str); // Loại bỏ dấu tiếng Việt
            str = str.trim().toLowerCase();  // Chuyển thành chữ thường và loại bỏ khoảng trắng ở đầu và cuối
            str = str.replace(/[^a-z0-9\s-]/g, '');  // Loại bỏ các ký tự đặc biệt
            str = str.replace(/\s+/g, '-');  // Thay khoảng trắng bằng dấu gạch ngang
            str = str.replace(/-+/g, '-');  // Loại bỏ các dấu gạch ngang thừa
            return str;
        }
        function updateSlug() {
            const titleInput = document.getElementById('title');
            const slugInput = document.getElementById('slug');
            slugInput.value = generateSlug(titleInput.value);
        }
    </script>

@endsection

@section('content')

    <ol class="breadcrumb breadcrumb-quirk">
        <li><a href="{{route('wadmin::dashboard.index.get')}}"><i class="fa fa-home mr5"></i> Dashboard</a></li>
        <li><a href="{{route('wadmin::post.index.get')}}">Bài viết</a></li>
        <li class="active">Sửa Bài viết</li>
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
                        <h4 class="panel-title">Sửa Bài viết</h4>
                        <p>Bạn cần nhập đầy đủ các thông tin để sửa Bài viết</p>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label>Tiêu đề</label>
                            <input class="form-control"
                                   name="name"
                                   id="title"
                                   type="text"
                                   value="{{$data->name}}"
                                   onkeyup="updateSlug()"
                                   placeholder="Tiêu đề bài viết">
                        </div>
                        <div class="form-group">
                            <label>Url ( Tự động lấy theo tiêu đề hoặc nhập form dưới )</label>
                            <input class="form-control"
                                   name="slug"
                                   type="text"
                                   id="slug"
                                   value="{{$data->slug}}"
                                   placeholder="Ex : tieu-de-bai-viet">
                        </div>
                        <div class="form-group">
                            <label>Mô tả</label>
                            <textarea id="" name="description" class="form-control" rows="3" placeholder="Mô tả ngắn">{{$data->description}}</textarea>

                        </div>
                        <div class="form-group">
                            <label>Nội dung bài viết
                                @if($data->content!='' || countStringVietnam($data->content)>=800)
                                    <span class="success-seo"><i class="fa fa-check-circle"></i></span>
                                @else
                                    <span class="error-seo"><i class="fa fa-close"></i></span>
                                @endif
                            </label>
                            <textarea id="editor1" name="content" class="form-control makeMeRichTextarea" rows="3" placeholder="Nội dung bài viết">{{$data->content}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Tags (Từ khóa cách nhau bởi dấu phẩy, không có khoảng trống)</label>
                            <input class="form-control" name="tags" value="{{$data->tags}}" type="text" placeholder="Từ khóa liên quan">
                        </div>
                        <div class="form-group">
                            <label>Thẻ Meta title
                                @if($data->meta_title!='' || countStringVietnam($data->meta_title)>=50)
                                    <span class="success-seo"><i class="fa fa-check-circle"></i></span>
                                @else
                                    <span class="error-seo"><i class="fa fa-close"></i></span>
                                @endif
                            </label>
                            <input class="form-control"
                                   name="meta_title"
                                   type="text"
                                   value="{{$data->meta_title}}"
                                   placeholder="">
                        </div>
                        <div class="form-group">
                            <label>Thẻ meta description
                                @if($data->meta_desc!='' || countStringVietnam($data->meta_desc)>=140)
                                <span class="success-seo"><i class="fa fa-check-circle"></i></span>
                                @else
                                    <span class="error-seo"><i class="fa fa-close"></i></span>
                                @endif
                            </label>
                            <textarea id="" name="meta_desc" class="form-control" rows="3" placeholder="Thẻ Meta description">{{$data->meta_desc}}</textarea>
                            <div class="huph-seo">
                                <ul>
                                    <li>Số ký tự : {{countStringVietnam($data->meta_desc)}}</li>
                                    <li class="">Số ký tự thẻ mô tả nên để từ 150 - 160 ký tự</li>
                                    @if($data->meta_desc=='' || countStringVietnam($data->meta_desc)<=20)
                                        <li class="error-seo">Thẻ mô tả meta description chưa được tối ưu <i class="fa fa-close"></i></li>
                                    @endif
                                </ul>
                            </div>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary">Lưu lại</button>
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
                            <label>Ngày viết</label>
                            <input class="form-control" type="date" name="created_at" value="{{format_date_display($data->created_at)}}">
                        </div>
                        <div class="form-group">
                            <label>Chọn chuyên mục</label>
                            <div class="table-responsive table-check">
                                <table class="table nomargin">
                                    <thead>
                                    <tr>
                                        <th>Tên chuyên mục</th>
                                        <th>check</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if(!empty($allCategory)): ?>
                                        <?php foreach($allCategory as $row): ?>
                                    <tr>
                                        <td style="font-weight: bold">{{$row->name}}</td>
                                        <td class="text-center">
                                            <label class="ckbox-primary">
                                                <input type="checkbox" name="category[]"
                                                       value="{{$row->id}}"  {!! (in_array($row->id, $currentCategories)) ? 'checked' : '' !!} >
                                                <span></span>
                                            </label>
                                        </td>
                                    </tr>
                                    @if($row->childs()->exists())
                                        @foreach($row->childs as $child)
                                            <tr>
                                                <td style="padding-left: 30px"><b>1.1 - </b> {{$child->name}}</td>
                                                <td class="text-center">
                                                    <label class="ckbox-primary">
                                                        <input type="checkbox" name="category[]"
                                                               value="{{$child->id}}" {!! (in_array($child->id, $currentCategories)) ? 'checked' : '' !!} >
                                                        <span></span>
                                                    </label>
                                                </td>
                                            </tr>
                                            @if($child->childs()->exists())
                                                @foreach($child->childs as $ch)
                                                    <tr>
                                                        <td style="padding-left: 50px"><b>1.2 - </b> {{$ch->name}}</td>
                                                        <td class="text-center">
                                                            <label class="ckbox-primary">
                                                                <input type="checkbox" name="category[]"
                                                                       {!! (in_array($ch->id, $currentCategories)) ? 'checked' : '' !!}
                                                                       value="{{$ch->id}}" >
                                                                <span></span>
                                                            </label>
                                                        </td>
                                                    </tr>
                                                    @if($ch->childs()->exists())
                                                        @foreach($ch->childs as $chs)
                                                            <tr>
                                                                <td style="padding-left: 60px"><b>1.3 - </b> {{$chs->name}}</td>
                                                                <td class="text-center">
                                                                    <label class="ckbox-primary">
                                                                        <input type="checkbox" name="category[]"
                                                                               value="{{$chs->id}}"
                                                                            {!! (in_array($chs->id, $currentCategories)) ? 'checked' : '' !!}
                                                                        >
                                                                        <span></span>
                                                                    </label>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach
                                    @endif
                                    <?php endforeach; ?>
                                    <?php endif; ?>

                                    </tbody>
                                </table>
                            </div><!-- table-responsive -->
                        </div>

                        <div class="form-group">
                            <label>File đính kèm (doc,docx,pdf)</label>
                            <div class="input-group col-xs-12" style="display: flex">
                                <input type="text" name="file_attach" value="{{$data->file_attach}}" id="ckfinder-input-1" class="form-control file-upload-info" placeholder="Upload file">
                                <span class="input-group-append">
                                <button class="file-upload-browse btn btn-primary" id="ckfinder-popup-1"  type="button">Chọn file</button>
                            </span>
                            </div>

                        </div>

                        <div class="form-group">
                            <p>Vị trí hiển thị</p>
                            <div class="checkbox-inline-s" style="padding-bottom: 10px">
                            	<label for="display">Tin mới</label>
                                <select name="display" class="form-control">
                                    <option value="0" {{($data->display==0) ? 'selected' : ''}}>Không hiển thị tin mới</option>
                                    <option value="1" {{($data->display==1) ? 'selected' : ''}}>Hiển thị tin mới</option>
                                </select>
                            </div>
                            <div class="checkbox-inline-s" style="padding-bottom: 10px">

                            	<label for="is_hot">Hiển thị nổi bật</label>
                                <select name="is_hot" class="form-control">
                                    <option value="0" {{($data->is_hot==0) ? 'selected' : ''}}>Không hiển thị nổi bật</option>
                                    <option value="1" {{($data->is_hot==1) ? 'selected' : ''}}>Hiển thị nổi bật</option>
                                </select>
                            </div>
                            <div class="checkbox-inline-s" style="padding-bottom: 10px">
                            	<label for="is_home">Hiển thị trang chủ</label>
                                <select name="is_home" class="form-control">
                                    <option value="0" {{($data->is_home==0) ? 'selected' : ''}}>Không hiển thị trang chủ</option>
                                    <option value="1" {{($data->is_home==1) ? 'selected' : ''}}>Hiển thị trang chủ</option>
                                </select>
                            </div>
                        </div>
                        @if($permissionPost->contains('name','status_active'))
                        <div class="form-group">
                            <label>Trạng thái</label>
                            <select id="" name="status" class="form-control" style="width: 100%" data-placeholder="Trạng thái">
                                <option value="active" {{ ($data->status=='active') ? 'selected' : ''}}>Duyệt bài ngay</option>
                                <option value="disable" {{ ($data->status=='disable') ? 'selected' : ''}}>Đợi duyệt</option>
                            </select>
                        </div>
                        @else
                            <div class="form-group">
                                <label>Trạng thái</label>
                            <select id="" name="status" class="form-control" style="width: 100%" data-placeholder="Trạng thái">
                                <option value="disable" {{ ($data->status=='disable') ? 'selected' : ''}}>Gửi duyệt</option>
                            </select>
                            </div>
                            @endif

                        <div class="form-group">
                            <label>Ảnh đại diện</label>
                            <div class="input-group col-xs-12" style="display: flex">
                                <input type="text" name="thumbnail" value="{{$data->thumbnail}}" id="ckfinder-input-2" class="form-control file-upload-info" placeholder="Upload Image">
                                <span class="input-group-append">
								<button class="file-upload-browse btn btn-primary" id="ckfinder-popup-2"  type="button">Chọn ảnh</button>
							</span>
                            </div>
                            <div class="col-xs-12">
                                <img src="{{($data->thumbnail!='') ? upload_url($data->thumbnail) : public_url('admin/themes/images/no-image.png')}}" id="imgreview" style="width: 100px; padding: 10px 0;">
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Banner</label>
                            <div class="input-group col-xs-12" style="display: flex">
                                <input type="text" name="banner" value="{{$data->banner}}" id="ckfinder-input-3" class="form-control file-upload-info" placeholder="Upload Image">
                                <span class="input-group-append">
								<button class="file-upload-browse btn btn-primary" id="ckfinder-popup-3"  type="button">Chọn ảnh</button>
							</span>
                            </div>
                            <div class="col-xs-12">
                                <img src="{{($data->banner!='') ? upload_url($data->banner) : public_url('admin/themes/images/no-image.png')}}" id="imgreview" style="width: 100px; padding: 10px 0;">
                            </div>
                        </div>

                        <div class="form-group" >
                            <label style="padding-top: 20px">QR Code cho bài viết</label>
                            <div class="qr-code" id="svgID" style="position: relative">
                              {!! GenQrCode(route('frontend::blog.detail.get',$data->slug)) !!}
                            </div>
                            <div style="padding-top: 20px">
                                <button type="button" onclick="downloadSVG()" >Download QR Code</button>
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
