@extends('wadmin-dashboard::master')

@section('js')

@endsection
@section('js-init')

@endsection

@section('content')

    <ol class="breadcrumb breadcrumb-quirk">
        <li><a href="{{route('wadmin::dashboard.index.get')}}"><i class="fa fa-home mr5"></i> Dashboard</a></li>
        <li><a href="{{route('wadmin::setting.index.get')}}">Cấu hình từ ngữ</a></li>
        <li class="active">Thông tin cấu hình</li>
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
                        <h4 class="panel-title">Thông tin cấu hình từ ngữ trên trang web</h4>
                        <p>Bạn cần nhập đầy đủ các thông tin để cấu hình thông tin mong muốn</p>
                    </div>
                    <div class="panel-body">

                        <div class="row">
                            <div class="col-lg-3 col-xs-6">
                                <div class="form-group">
                                    <input class="form-control"
                                           name="keyword_1_{{$language}}"
                                           type="text"
                                           value="{{$setting->getSettingMeta('keyword_1_'.$language)}}"
                                           placeholder="Thông tin tuyển sinh">
                                </div>
                            </div>
                            <div class="col-lg-3 col-xs-6">
                                <div class="form-group">
                                    <input class="form-control"
                                           name="keyword_2_{{$language}}"
                                           type="text"
                                           value="{{$setting->getSettingMeta('keyword_2_'.$language)}}"
                                           placeholder="Bạn đã sẵn sàng">
                                </div>
                            </div>
                            <div class="col-lg-3 col-xs-6">
                                <div class="form-group">
                                    <input class="form-control"
                                           name="keyword_3_{{$language}}"
                                           type="text"
                                           value="{{$setting->getSettingMeta('keyword_3_'.$language)}}"
                                           placeholder="Tham gia ngay với chúng tôi nào!">
                                </div>
                            </div>
                            <div class="col-lg-3 col-xs-6">
                                <div class="form-group">
                                    <input class="form-control"
                                           name="keyword_4_{{$language}}"
                                           type="text"
                                           value="{{$setting->getSettingMeta('keyword_4_'.$language)}}"
                                           placeholder="Nguyện vọng của bạn là gì">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-xs-6">
                                <label></label>
                                <div class="form-group">
                                    <input class="form-control"
                                           name="keyword_5_{{$language}}"
                                           type="text"
                                           value="{{$setting->getSettingMeta('keyword_5_'.$language)}}"
                                           placeholder="Khám phá Trường Đại học Y tế công cộng">
                                </div>
                            </div>
                            <div class="col-lg-3 col-xs-6">
                                <label></label>
                                <div class="form-group">
                                    <input class="form-control"
                                           name="keyword_6_{{$language}}"
                                           type="text"
                                           value="{{$setting->getSettingMeta('keyword_6_'.$language)}}"
                                           placeholder="Đối tác và nhà tài trợ quốc tế">
                                </div>
                            </div>
                            <div class="col-lg-3 col-xs-6">
                                <label></label>
                                <div class="form-group">
                                    <input class="form-control"
                                           name="keyword_7_{{$language}}"
                                           type="text"
                                           value="{{$setting->getSettingMeta('keyword_7_'.$language)}}"
                                           placeholder="CÒN CHỜ GÌ NỮA HÃY LIÊN HỆ NGAY VỚI CHÚNG TÔI ĐỂ ĐƯỢC TƯ VẤN CÁC HUPHERS TƯƠNG LAI NHÉ!">
                                </div>
                            </div>
                            <div class="col-lg-3 col-xs-6">
                                <label></label>
                                <div class="form-group">
                                    <input class="form-control"
                                           name="keyword_8_{{$language}}"
                                           type="text"
                                           value="{{$setting->getSettingMeta('keyword_8_'.$language)}}"
                                           placeholder="Tin tức nổi bật và các bài báo, học bổng">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-xs-6">
                                <label></label>
                                <div class="form-group">
                                    <input class="form-control"
                                           name="keyword_9_{{$language}}"
                                           type="text"
                                           value="{{$setting->getSettingMeta('keyword_9_'.$language)}}"
                                           placeholder="Link nhanh">
                                </div>
                            </div>
                            <div class="col-lg-3 col-xs-6">
                                <label></label>
                                <div class="form-group">
                                    <input class="form-control"
                                           name="keyword_10_{{$language}}"
                                           type="text"
                                           value="{{$setting->getSettingMeta('keyword_10_'.$language)}}"
                                           placeholder="Liên hệ">
                                </div>
                            </div>
                            <div class="col-lg-3 col-xs-6">
                                <label></label>
                                <div class="form-group">
                                    <input class="form-control"
                                           name="keyword_11_{{$language}}"
                                           type="text"
                                           value="{{$setting->getSettingMeta('keyword_11_'.$language)}}"
                                           placeholder="Địa chỉ">
                                </div>
                            </div>
                            <div class="col-lg-3 col-xs-6">
                                <label></label>
                                <div class="form-group">
                                    <input class="form-control"
                                           name="keyword_12_{{$language}}"
                                           type="text"
                                           value="{{$setting->getSettingMeta('keyword_12_'.$language)}}"
                                           placeholder="Trường Đại học Y tế công cộng">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-xs-6">
                                <label></label>
                                <div class="form-group">
                                    <input class="form-control"
                                           name="keyword_13_{{$language}}"
                                           type="text"
                                           value="{{$setting->getSettingMeta('keyword_13_'.$language)}}"
                                           placeholder="Lịch sử hình thành và phát triển">
                                </div>
                            </div>
                            <div class="col-lg-3 col-xs-6">
                                <label></label>
                                <div class="form-group">
                                    <input class="form-control"
                                           name="keyword_14_{{$language}}"
                                           type="text"
                                           value="{{$setting->getSettingMeta('keyword_14_'.$language)}}"
                                           placeholder="Mô tả lịch sử hình thành">
                                </div>
                            </div>
                            <div class="col-lg-3 col-xs-6">
                                <label></label>
                                <div class="form-group">
                                    <input class="form-control"
                                           name="keyword_15_{{$language}}"
                                           type="text"
                                           value="{{$setting->getSettingMeta('keyword_15_'.$language)}}"
                                           placeholder="TIN TỨC NỔI BẬT">
                                </div>
                            </div>
                            <div class="col-lg-3 col-xs-6">
                                <label></label>
                                <div class="form-group">
                                    <input class="form-control"
                                           name="keyword_16_{{$language}}"
                                           type="text"
                                           value="{{$setting->getSettingMeta('keyword_16_'.$language)}}"
                                           placeholder="Liên hệ">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-xs-6">
                                <label></label>
                                <div class="form-group">
                                    <input class="form-control"
                                           name="keyword_17_{{$language}}"
                                           type="text"
                                           value="{{$setting->getSettingMeta('keyword_17_'.$language)}}"
                                           placeholder="Địa chỉ">
                                </div>
                            </div>
                            <div class="col-lg-3 col-xs-6">
                                <label></label>
                                <div class="form-group">
                                    <input class="form-control"
                                           name="keyword_18_{{$language}}"
                                           type="text"
                                           value="{{$setting->getSettingMeta('keyword_18_'.$language)}}"
                                           placeholder="Điện thoại">
                                </div>
                            </div>
                            <div class="col-lg-3 col-xs-6">
                                <label></label>
                                <div class="form-group">
                                    <input class="form-control"
                                           name="keyword_19_{{$language}}"
                                           type="text"
                                           value="{{$setting->getSettingMeta('keyword_19_'.$language)}}"
                                           placeholder="Gửi tin nhắn">
                                </div>
                            </div>
                            <div class="col-lg-3 col-xs-6">
                                <label></label>
                                <div class="form-group">
                                    <input class="form-control"
                                           name="keyword_20_{{$language}}"
                                           type="text"
                                           value="{{$setting->getSettingMeta('keyword_20_'.$language)}}"
                                           placeholder="Tiêu đề">
                                </div>
                            </div>
                            <div class="col-lg-3 col-xs-6">
                                <label></label>
                                <div class="form-group">
                                    <input class="form-control"
                                           name="keyword_21_{{$language}}"
                                           type="text"
                                           value="{{$setting->getSettingMeta('keyword_21_'.$language)}}"
                                           placeholder="Nội dung">
                                </div>
                            </div>
                            <div class="col-lg-3 col-xs-6">
                                <label></label>
                                <div class="form-group">
                                    <input class="form-control"
                                           name="keyword_22_{{$language}}"
                                           type="text"
                                           value="{{$setting->getSettingMeta('keyword_22_'.$language)}}"
                                           placeholder="Họ và tên">
                                </div>
                            </div>
                        </div>




                        <div class="form-group" style="padding-top: 50px">
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
                            <button class="btn btn-primary">Lưu lại</button>
                            <button class="btn btn-success" name="continue_post" value="1">Lưu và tiếp tục thêm</button>
                        </div>

                    </div><!-- col-sm-6 -->
                </div><!-- row -->

            </div>

        </form>
    </div>
@endsection
