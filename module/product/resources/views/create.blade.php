@extends('wadmin-dashboard::master')

@section('css')
    <link rel="stylesheet" href="{{asset('admin/themes/lib/select2/select2.css')}}">
@endsection
@section('css-init')
    <style>
        #showImage img{
            max-width: 100%;
        }
        .show-progress{
            padding-top: 20px;
        }
        .remove-img{
            position: relative;
        }
        .remove-img span{
            display: inline-block;
            width: 20px;
            height: 20px;
            background: red;
            line-height: 16px;
            text-align: center;
            color: #fff;
            border-radius: 100%;
            font-size: 15px;
            cursor: pointer;
            position: absolute;
        }
        .button-add-color{
        	padding-top: 20px;
        }
        .remove-item, .remove-item-size{
        	font-size: 20px;
        	color: #c00;
        	position: relative;
        	top: 4px;
        	cursor: pointer;
        }
        .item-pro, .item-pro-size{
        	padding-bottom: 10px;
        }
    </style>
@endsection

@section('js')
    <script type="text/javascript" src="{{asset('admin/libs/ckeditor/ckeditor.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/libs/ckfinder/ckfinder.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/js/main.js')}}"></script>
    <script src="{{asset('admin/themes/lib/select2/select2.js')}}"></script>
@endsection
@section('js-init')
    <script type="text/javascript">
        CKEDITOR.replace( 'editor1', {
            filebrowserBrowseUrl: '{{asset("admin/libs/ckfinder/ckfinder.html")}}',
            filebrowserImageBrowseUrl: '{{asset("admin/libs/ckfinder/ckfinder.html?type=Images")}}',
            filebrowserUploadUrl: '{{route('ckeditor.upload',['_token' => csrf_token() ])}}', //route dashboard/upload
            filebrowserUploadMethod: 'form'
        });
        CKEDITOR.replace( 'editor2', {
            filebrowserBrowseUrl: '{{asset("admin/libs/ckfinder/ckfinder.html")}}',
            filebrowserImageBrowseUrl: '{{asset("admin/libs/ckfinder/ckfinder.html?type=Images")}}',
            filebrowserUploadUrl: '{{route('ckeditor.upload',['_token' => csrf_token() ])}}', //route dashboard/upload
            filebrowserUploadMethod: 'form'
        });
        CKEDITOR.replace( 'editor3', {
            filebrowserBrowseUrl: '{{asset("admin/libs/ckfinder/ckfinder.html")}}',
            filebrowserImageBrowseUrl: '{{asset("admin/libs/ckfinder/ckfinder.html?type=Images")}}',
            filebrowserUploadUrl: '{{route('ckeditor.upload',['_token' => csrf_token() ])}}', //route dashboard/upload
            filebrowserUploadMethod: 'form'
        });
    </script>
    <script type="text/javascript">
        $("#select1").select2({  });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            var i=0;
            var dataImage = new Array();
            var dataPosition = new Array();
            let publicPath = '{{ public_url("") }}';

            $("#ImgUpload").change(function(){
                var formData = new FormData();
                var productid = $('#ImgUpload').attr('data-product');

                var checkImage = this.value;
                var ext = checkImage.substring(checkImage.lastIndexOf('.') + 1).toLowerCase();
                if (ext == "gif" || ext == "png" || ext == "jpg" || ext == "jpeg")
                {
                    // change(this);
                    var file = document.getElementById('ImgUpload').files[0];
                    dataImage[i]=file; //add push to array dataImage
                    dataPosition[i]=i;  //add push position to dataPosition
                    //created html progress
                    var html_progress = '<div class="progress" style="margin-bottom:5px;"><div class="progress-bar" id="progress-'+i+'" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div></div>';
                    $(".show-progress").append(html_progress);
                    i++;

                    formData.append('image',file);
                    formData.append('productid',productid);
                    console.log(productid);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type:'POST',
                        url:'{{route("ajax.media.muti.get")}}',
                        data:formData,
                        contentType: false,
                        dataType:'json',
                        processData: false,
                        cache:false,
                        success:function(data){
                            var addImage = '<div class="col-md-3" id="img-'+data.id+'"><div class="remove-img"><span class="rm-img" data-id="'+data.id+'" data-link="'+data.path_name+'">x</span><img src="'+publicPath+data.path_name+'"></div></div>';
                            //add image to div="showImage"
                            $("#showImage").append(addImage);
                        }

                    });
                }
                else
                    alert("Please select image file (jpg, jpeg, png).")
            });

            //remove image
            $('.rm-img').on('click',function (e) {
                e.preventDefault();
                let _this = $(e.currentTarget);
                let id = _this.attr('data-id');
                let link = _this.attr('data-link');
                $.ajax({
                    type: "POST",
                    url: "{{route('ajax.media.delete.get')}}" ,
                    data: {id,link},
                    success: function (result) {
                        $('#img-'+id).remove();
                    },
                    error : function() {
                        alert("submit failed");
                    }
                });
            })

            //thêm thuộc tính
            $('#listPro').hide();
            $('#listSize').hide();
            $('#AddColorButton').hide();
            $('#AddSizeButton').hide();

            $('#OnProperties').on('click',function(e){
            	 var checked = $(this).is(':checked');
            	 if($(this).is(":checked")) {
		            $('#listPro').show(100);
		            $('#AddColorButton').show();
		        } else {
		            $('#listPro').hide(100);
		            $('#AddColorButton').hide();
		        }
            });
            //thêm mầu
            let keyItem = $('.item-pro:last-child').attr('data-index');
            var count = keyItem+++1;
            $('#btnAddColor').on('click',function(e){
            	e.preventDefault();
            	$('#listPro').append('<div class="item-pro index'+count+'"><div class="row"><div class="col-lg-4"><input type="text" class="form-control" name="colors['+count+'][name]" placeholder="Mầu sắc"></div><div class="col-lg-4"><input type="text" class="form-control" name="colors['+count+'][size]" placeholder="Kích thước"></div><div class="col-lg-3"><input type="text" onkeyup="this.value=FormatNumber(this.value);" class="form-control" name="colors['+count+'][price]" placeholder="Giá"></div><div class="col-lg-1"><span class="remove-item" data-id="index'+count+'"><i class="fa fa-remove"></i></span></div></div></div>');
            	count++;
            });
            //remove mầu
            $(document).on("click",".remove-item",function(e){
			    e.preventDefault();
            	let _this = $(e.currentTarget);
            	let id = _this.attr('data-id');
            	$('.'+id).remove();
            	count--;
			});

            //remove size
            let sizeItem = $('.item-pro-size:last-child').attr('data-index');
            var counts = sizeItem+++1;
            $(document).on("click",".remove-item-size",function(e){
                e.preventDefault();
                let _this = $(e.currentTarget);
                let id = _this.attr('data-id');
                $('.'+id).remove();
                counts--;
            });

            $('#OnSize').on('click',function(e){
            	 var checked = $(this).is(':checked');
            	 if($(this).is(":checked")) {
		            $('#listSize').show(100);
		            $('#AddSizeButton').show();
		        } else {
		            $('#listSize').hide(100);
		            $('#AddSizeButton').hide();
		        }
            });
            //them size
            $('#btnAddSize').on('click',function(e){
            	e.preventDefault();
            	$('#listSize').append('<div class="item-pro-size size'+counts+'"><div class="row"><div class="col-lg-6"><input type="text" class="form-control" name="size['+counts+'][name]" placeholder="Kích thước"></div><div class="col-lg-5"><input type="text" onkeyup="this.value=FormatNumber(this.value);" class="form-control" name="size['+counts+'][price]" placeholder="Giá"></div><div class="col-lg-1"><span class="remove-item-size" data-id="size'+counts+'"><i class="fa fa-remove"></i></span></div></div></div>');
                counts++;
            });


        });
    </script>
@endsection

@section('content')

    <ol class="breadcrumb breadcrumb-quirk">
        <li><a href="{{route('wadmin::dashboard.index.get')}}"><i class="fa fa-home mr5"></i> Dashboard</a></li>
        <li><a href="{{route('wadmin::product.index.get')}}">Sản phẩm</a></li>
        <li class="active">Thêm sản phẩm</li>
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
                        <h4 class="panel-title">Thêm sản phẩm</h4>
                        <p>Bạn cần nhập đầy đủ các thông tin để thêm sản phẩm mới</p>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label>Tiêu đề</label>
                            <input class="form-control"
                                   name="name"
                                   type="text"
                                   value="{{old('name')}}"
                                   placeholder="Tên sản phẩm">
                        </div>
                        <div class="form-group">
                            <label>SKU</label>
                            <input class="form-control"
                                   name="sku"
                                   type="text"
                                   value="{{old('sku')}}"
                                   placeholder="Mã sản phẩm">
                        </div>

                        <div class="form-group">
                            <label>Mô tả ngắn</label>
                            <textarea id="" name="description" class="form-control" rows="3" placeholder="Mô tả ngắn sản phẩm">{{old('description')}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Nội dung sản phẩm</label>
                            <textarea id="editor1" name="content" class="form-control makeMeRichTextarea" rows="3" placeholder="Nội dung sản phẩm">{{old('content')}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Thông số</label>
                            <textarea id="editor2" name="product_meta" class="form-control makeMeRichTextarea" rows="3" placeholder="Thông tin ưu đãi">{{old('product_meta')}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Câu hỏi thường gặp</label>
                            <textarea id="editor3" name="chapter" class="form-control makeMeRichTextarea" rows="3" placeholder="Thông tin ưu đãi">{{old('chapter')}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Giá sản phẩm</label>
                            <input class="form-control"  onkeyup="this.value=FormatNumber(this.value);" name="price" value="{{old('price',0)}}" type="text" placeholder="Giá bán">
                        </div>
                        <div class="form-group">
                            <label>Giá cũ</label>
                            <input class="form-control" onkeyup="this.value=FormatNumber(this.value);" name="disprice" value="{{old('disprice',0)}}" type="text" placeholder="Giá gốc">
                        </div>
                        <div class="form-group">
                            <label>Giảm giá (%)</label>
                            <input class="form-control" min="0" max="100" name="discount" value="{{old('discount',0)}}" type="number" placeholder="Giảm giá">
                        </div>
                        <div class="form-group">
                        	<label>Bật thêm biến thể </label>
                        	<input type="checkbox" name="enable_color" value="1" id="OnProperties">
                        	<div id="listPro">

	                        	<div class="item-pro index0" data-index="0">
	                        		<div class="row">
	                        			<div class="col-lg-4">
	                        				<input type="text" class="form-control" name="colors[0][name]" placeholder="Mầu sắc">
	                        			</div>
                                        <div class="col-lg-4">
                                            <input type="text" class="form-control" name="colors[0][size]" placeholder="Kích thước">
                                        </div>
	                        			<div class="col-lg-3">
	                        				<input type="text" onkeyup="this.value=FormatNumber(this.value);" class="form-control" name="colors[0][price]" placeholder="Giá">
	                        			</div>
	                        			<div class="col-lg-1">
	                        				<span class="remove-item" data-id="index0"><i class="fa fa-remove"></i></span>
	                        			</div>
	                        		</div>
	                        	</div>



                        	</div>

                        	<div class="button-add-color" id="AddColorButton">
	                        	<button type="button" id="btnAddColor"><i class="fa fa-plus"></i> Thêm mầu</button>
	                        </div>


                        </div>
                        <div class="form-group">
                        	<label>Bật thêm kích thước </label>
                        	<input type="checkbox" name="enable_size" value="1" id="OnSize">
                        	<div id="listSize">
	                        	<div class="item-pro-size size0" data-index="0">
	                        		<div class="row">
	                        			<div class="col-lg-6">
	                        				<input type="text" class="form-control" name="size[0][name]" placeholder="Kích thước">
	                        			</div>
	                        			<div class="col-lg-5">
	                        				<input type="text" onkeyup="this.value=FormatNumber(this.value);" class="form-control" name="size[0][price]" placeholder="Giá">
	                        			</div>
	                        			<div class="col-lg-1">
	                        				<span class="remove-item-size" data-id="size0"><i class="fa fa-remove"></i></span>
	                        			</div>
	                        		</div>
	                        	</div>
                        	</div>

                        	<div class="button-add-color" id="AddSizeButton">
	                        	<button type="button" id="btnAddSize"><i class="fa fa-plus"></i> Thêm kích thước</button>
	                        </div>

                        </div>
                        <div class="form-group">
                            <label>Từ khóa liên quan</label>
                            <input class="form-control"
                                   name="meta_keyword"
                                   type="text"
                                   value="{{old('meta_keyword')}}"
                                   placeholder="Cách nhau bằng dấu ,">
                        </div>
                        <div class="form-group">
                            <label>Thẻ Meta title</label>
                            <input class="form-control"
                                   name="meta_title"
                                   type="text"
                                   value="{{old('meta_title')}}"
                                   placeholder="Nhập hoặc để trống tự động lấy theo tên">
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
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label>Danh mục sản phẩm</label>
                            <select id="" name="cat_id" class="form-control" style="width: 100%" data-placeholder="Danh mục sản phẩm">
                                <option value="">--Chọn danh mục--</option>
                                {{$catmodel->optionCat(0,1,4,0,0)}}
                            </select>
                        </div>


                        <div class="form-group">
                            <label>Vị trí hiển thị</label>
                            <select id="" name="display" class="form-control" style="width: 100%" data-placeholder="Trạng thái">
                                <option value="0" {{ (old('display') ==0 ) ? 'selected' : ''}}>Không chọn</option>
                                <option value="2" {{ (old('display') ==2 ) ? 'selected' : ''}}>Nổi bật</option>
                                <option value="3" {{ (old('display') ==3 ) ? 'selected' : ''}}>Slider</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Thứ tự ưu tiên</label>
                            <input class="form-control"
                                   name="age"
                                   type="text"
                                   value="{{old('age')}}"
                                   placeholder="Từ thấp đến cao">
                        </div>

                        <div class="form-group">
                            <p><input type="checkbox" name="freeship" value="1" {{(old('freeship')==1) ? 'checked' : ''}}> Free ship</p>
                            <p><input type="checkbox" name="lapdat" value="1" {{(old('lapdat')==1) ? 'checked' : ''}}> Miễn phí lắp đặt</p>
                        </div>
                        <div class="form-group">
                            <label>Thuộc tính nổi bật</label>

                                   <select name="thuoctinh" class="form-control">
                                       <option value="">Chọn thuộc tính</option>
                                       @foreach($gallery as $d)
                                        <option value="{{$d->thumbnail}}">{{$d->name}}</option>
                                       @endforeach
                                   </select>
                        </div>
                        <div class="form-group">
                            <label>Hiển thị bán chạy</label>
                            <select id="" name="main_display" class="form-control" style="width: 100%" data-placeholder="">
                                <option value="" {{ (old('main_display') ==0) ? 'selected' : ''}}>Không chọn</option>
                                <option value="1" {{ (old('main_display') ==1 ) ? 'selected' : ''}}>Có</option>
                            </select>

                        </div>
                        <div class="form-group">
                            <label>Trạng thái ( Cho phép hiển thị hoặc tạm ẩn sản phẩm )</label>
                            <select id="" name="status" class="form-control" style="width: 100%" data-placeholder="Trạng thái">
                                <option value="active" {{ (old('status')=='active') ? 'selected' : ''}}>Hiển thị</option>
                                <option value="disable" {{ (old('status')=='disable') ? 'selected' : ''}}>Tạm ẩn</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Hình ảnh</label>
                            <div class="input-group col-xs-12" style="display: flex">
                                <input type="text" name="thumbnail" value="<?= old('thumbnail'); ?>" id="ckfinder-input-1" class="form-control file-upload-info" placeholder="Upload Image">
                                <span class="input-group-append">
                                <button class="file-upload-browse btn btn-primary" id="ckfinder-popup-1"  type="button">Chọn ảnh</button>
                            </span>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label>Ảnh kèm theo</label>
                            <div class="form-group">
                                <div class="upload-cc" style="display: flex">
                                    <input type="file" name="files"  class="form-control selectImage file-upload-info" id="ImgUpload" data-product="{{$currentId}}"/>
                                </div>

                            </div>


                            <div class="row justify-content-center" id="showImage">
                                @if($imageAttach)
                                    @foreach($imageAttach as $d)
                                        <div class="col-lg-3" id="img-{{$d->id}}">
                                            <div class="remove-img">
                                                <span class="rm-img" data-id="{{$d->id}}" data-link="{{$d->path_name}}">x</span>
                                                <img src="{{public_url($d->path_name)}}">
                                            </div>
                                        </div>
                                    @endforeach
                                @endif

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
