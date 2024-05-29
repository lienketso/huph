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
    <script>
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

    <script type="text/javascript">
        $(document).ready(function() {
            function autoSave() {
                let post_id = $('#post_id').val();
                let title = $('#title').val();
                let post_type = $('#post_type').val();
                let slug = $('#slug').val();
                let description = $('#description').val();
                let contents = CKEDITOR.instances.editor1.getData();
                if (title.length >= 1) {
                    $.ajax({
                        url: "{{ route('ajax.save-post.get') }}",
                        method: "POST",
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            post_id: post_id,
                            title: title,
                            description: description,
                            contents: contents,
                            post_type: post_type,
                            slug:slug
                        },
                        success: function (response) {
                            $('#post_id').val(response.post_id);
                            let UrlPreview = response.newUrl;
                            $('#PreviewPost').attr('href', UrlPreview);
                        }
                    });
                }
            }

            setInterval(autoSave, 20000); // Lưu bản nháp mỗi 20 giây

        });
    </script>
@endsection

@section('content')

    <ol class="breadcrumb breadcrumb-quirk">
        <li><a href="{{route('wadmin::dashboard.index.get')}}"><i class="fa fa-home mr5"></i> Dashboard</a></li>
        <li><a href="{{route('wadmin::post.index.get')}}">Bài viết</a></li>
        <li class="active">Thêm Bài viết</li>
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
                        <h4 class="panel-title">Thêm Bài viết</h4>
                        <p>Bạn cần nhập đầy đủ các thông tin để thêm Bài viết mới</p>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label>Tiêu đề</label>
                            <input type="hidden" name="post_id" id="post_id">
                            <input type="hidden" name="post_type" id="post_type" value="blog">
                            <input class="form-control"
                                   name="name"
                                   id="title"
                                   type="text"
                                   value="{{old('name')}}"
                                   onkeyup="updateSlug()"
                                   placeholder="Tiêu đề bài viết">
                        </div>
                        <div class="form-group">
                            <label>Url ( Tự động lấy theo tiêu đề hoặc nhập form dưới )</label>
                            <input class="form-control"
                                   name="slug"
                                   type="text"
                                   id="slug"
                                   value="{{old('slug')}}"
                                   placeholder="Ex : tieu-de-bai-viet">
                        </div>
                        <div class="form-group">
                            <label>Mô tả</label>
                            <textarea id="description" name="description" class="form-control" rows="3" placeholder="Mô tả ngắn">{{old('description')}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Nội dung bài viết</label>
                            <textarea id="editor1" name="content" class="form-control makeMeRichTextarea" rows="3" placeholder="Nội dung bài viết">{{old('content')}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Tags (Từ khóa cách nhau bởi dấu phẩy, không có khoảng trống)</label>
                            <input class="form-control" name="tags" type="text" placeholder="Từ khóa liên quan">
                        </div>
                        <div class="form-group">
                            <label>Thẻ Meta title</label>
                            <input class="form-control"
                                   name="meta_title"
                                   type="text"
                                   value="{{old('meta_title')}}"
                                   placeholder="">
                        </div>
                        <div class="form-group">
                            <label>Thẻ meta description</label>
                            <textarea id="" name="meta_desc" class="form-control" rows="3" placeholder="Thẻ Meta description">{{old('meta_desc')}}</textarea>
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
                        <div class="btn-preview">
                            <a id="PreviewPost" target="_blank" href=""><i class="fa fa-eye"></i> Preview post</a>
                        </div>
                    </div>
                    <div class="panel-body">

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
                                                               value="{{$row->id}}" >
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
                                                               value="{{$child->id}}" >
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
                                                                                   value="{{$chs->id}}" >
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

                        <div class="list-meta" id="ListMeta">
                            @foreach($catMeta as $d)
                                <div class="metaTopic {{$d->meta_value}} nodeall n{{$d->category}}" id="node_{{$d->id}}" >
                                    @include('wadmin-post::meta.'.$d->meta_value)
                                </div>
                            @endforeach
                        </div>

                        <div class="form-group">
                            <label>File đính kèm (doc,docx,pdf)</label>
                            <div class="input-group col-xs-12" style="display: flex">
                                <input type="text" name="file_attach" value="" id="ckfinder-input-1" class="form-control file-upload-info" placeholder="Upload file">
                                <span class="input-group-append">
                                <button class="file-upload-browse btn btn-primary" id="ckfinder-popup-1"  type="button">Chọn file</button>
                            </span>
                            </div>

                        </div>

                        <div class="form-group">
                            <p>Vị trí hiển thị</p>
                            <div class="checkbox-inline">
                                <input type="checkbox" name="display" id="display" value="1" >
                                <label for="display">Tin mới</label>
                            </div>
{{--                            <div class="checkbox-inline">--}}
{{--                                <input type="checkbox" name="is_slider" id="is_slider" value="1" >--}}
{{--                                <label for="is_slider">Hiển thị tại slider</label>--}}
{{--                            </div>--}}
                            <div class="checkbox-inline">
                                <input type="checkbox" name="is_hot" id="is_hot" value="1" >
                                <label for="is_hot">Hiển thị nổi bật</label>
                            </div>
                            <div class="checkbox-inline">
                                <input type="checkbox" name="is_home" id="is_home" value="1" >
                                <label for="is_home">Hiển thị trang chủ</label>
                            </div>
                        </div>

                        <div class="form-group">
                            @if($permissionPost->contains('name','status_active'))
                            <label>Trạng thái</label>
                            <select id="" name="status" class="form-control" style="width: 100%" data-placeholder="Trạng thái">
                                <option value="active" {{ (old('status')=='active') ? 'selected' : ''}}>Duyệt bài ngay</option>
                                <option value="disable" {{ (old('status')=='disable') ? 'selected' : ''}}>Tạm ẩn</option>
                            </select>
                            @else
                                <select id="" name="status" class="form-control" style="width: 100%" data-placeholder="Trạng thái">
                                    <option value="disable" {{ (old('status')=='disable') ? 'selected' : ''}}>Gửi duyệt</option>
                                </select>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Ảnh đại diện</label>
                            <div class="input-group col-xs-12" style="display: flex">
                                <input type="text" name="thumbnail" value="<?= old('thumbnail'); ?>" id="ckfinder-input-2" class="form-control file-upload-info" placeholder="Upload Image">
                                <span class="input-group-append">
								<button class="file-upload-browse btn btn-primary" id="ckfinder-popup-2"  type="button">Chọn ảnh</button>
							</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Banner</label>
                            <div class="input-group col-xs-12" style="display: flex">
                                <input type="text" name="banner" value="<?= old('banner'); ?>" id="ckfinder-input-3" class="form-control file-upload-info" placeholder="Upload Image">
                                <span class="input-group-append">
								<button class="file-upload-browse btn btn-primary" id="ckfinder-popup-3"  type="button">Chọn ảnh</button>
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
