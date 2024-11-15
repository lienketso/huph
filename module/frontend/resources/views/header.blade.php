@php
    $menus = getAllmenu();
@endphp
<header class="mb-2 fixed-header desktop">
    <div class="container d-flex flex-wrap justify-content-center hot-line">
        <a
            href="https://huph.edu.vn"
            class="d-flex align-items-center mb-3 mb-lg-0 me-lg-auto link-body-emphasis text-decoration-none"
        >
            <img src="{{($setting['site_logo']!='') ? upload_url($setting['site_logo']) : asset('frontend/assets/image/logo.png')}}" width="175" alt="Logo huph" />
        </a>
        <span class="me-3">
          <i class="fa-solid fa-location-dot"></i> {{$setting['site_address_'.$lang]}}
        </span>
        <span>
          <i class="fa-solid fa-phone"></i>
          <a href="tel:{{str_replace(' ','',$setting['site_hotline_'.$lang])}}"> {{$setting['site_hotline_'.$lang]}}</a>
        </span>
    </div>
    <nav class="navbar navbar-expand-lg nav-fill snip1135">
    <div class="container">


                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        @foreach($menus as $key=>$menu)
                            @if(count($menu->childs))
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="{{$menu->link}}" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        @if($menu->thumbnail!='')
                                            <i class="{{$menu->thumbnail}}"></i>
                                        @endif
                                        {{$menu->name}}
                                    </a>

                                    <ul class="dropdown-menu">
                                        @foreach($menu->childs as $subone)
                                            @if(count($subone->childs))
                                                <li class="nav-item dropend">
                                                    <a class="nav-link dropdown-toggle" href="{{$subone->link}}" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                       {{$subone->name}}
                                                    </a>

                                                    <ul class="dropdown-menu">
                                                        @foreach($subone->childs as $subtwo)
                                                            @if(count($subtwo->childs))
                                                                <li class="nav-item dropend">

                                                                    <a class="nav-link dropdown-toggle" href="{{$subtwo->link}}" role="button"
                                                                       data-bs-toggle="dropdown" aria-expanded="false">
                                                                        {{$subtwo->name}}
                                                                    </a>

                                                                    <ul class="dropdown-menu">
                                                                        @foreach($subtwo->childs as $subthree)
                                                                        <li><a class="dropdown-item" href="{{$subthree->link}}">{{$subthree->name}}</a></li>
                                                                        @endforeach

                                                                    </ul>
                                                                </li>
                                                            @else
                                                        <li><a class="dropdown-item" href="{{$subtwo->link}}">{{$subtwo->name}}</a></li>
                                                            @endif
                                                        @endforeach

                                                    </ul>
                                                </li>
                                            @else
                                        <li><a class="dropdown-item" href="{{$subone->link}}">{{$subone->name}}</a></li>
                                            @endif
                                        @endforeach


                                    </ul>
                                </li>
                            @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{$menu->link}}">
                                @if($menu->thumbnail!='')
                                    <i class="{{$menu->thumbnail}}"></i>
                                @endif
                                {{$menu->name}}</a>
                        </li>
                            @endif
                        @endforeach

                            <a
                                class="nav-link"
                                href="#"
                                data-bs-toggle="modal"
                                data-bs-target="#formModal"
                            ><i class="fa-regular fa-calendar-check"></i>Kết quả
                                tuyển sinh</a>

                    </ul>

                </div>


    </div>
    </nav>
</header>

<header class="fixed-header mobile">
    <div class="container">

        <nav class="navbar-mobile">
            <div class="container-fluid">

                <button class="navbar-toggler-mobile" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <img src="{{asset('frontend/assets/image/menu-toggle.png')}}" alt="Menu toggle">
                </button>
                <div class="collapse navbar-collapse-mb justify-content-end" id="navbarNav">
                    <a class="navbar-brand" href="{{route('frontend::home')}}">
                        <img src="{{($setting['site_logo']!='') ? upload_url($setting['site_logo']) : asset('frontend/assets/image/logo.png')}}" width="175" />
                    </a>
                    <ul class="navbar-nav">
                        @foreach($menus as $key=>$menu)
                            @if(count($menu->childs))
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" aria-current="page" href="{{$menu->link}}">
                                @if($menu->thumbnail!='')
                                    <i class="{{$menu->thumbnail}}"></i>
                                @endif {{$menu->name}}</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                @foreach($menu->childs as $subone)
                                    <li><a class="dropdown-item" href="{{$subone->link}}">{{$subone->name}}</a></li>
                                @endforeach

                            </ul>
                        </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link" href="{{$menu->link}}"> @if($menu->thumbnail!='')
                                            <i class="{{$menu->thumbnail}}"></i>
                                        @endif {{$menu->name}}</a>
                                </li>
                            @endif
                        @endforeach
                        <li>
                            <a
                                class="nav-link"
                                href="#"
                                data-bs-toggle="modal"
                                data-bs-target="#formModal"
                            ><i class="fa-regular fa-calendar-check"></i>Kết quả
                                tuyển sinh</a>
                        </li>
                    </ul>
                    <span class="close-menu-mobile"><i class="fa-regular fa-chevron-left"></i></span>
                </div>
            </div>
        </nav>
        <div class="row">
            <div class="col-6 mt-2 text-center">
                <a href="/" class="">
                    <img src="{{asset('frontend/assets/image/logo.svg')}}" width="512" />
                </a>
            </div>
            <div class="col-6 mt-2">
                <a href="tel:{{str_replace(' ','',$setting['site_hotline_'.$lang])}}">
                    <img src="{{asset('frontend/assets/image/mobile/icon/phone.png')}}"/>
                </a>
                <img src="{{asset('frontend/assets/image/mobile/icon/addr.png')}}" class="mb-2" />
            </div>
        </div>
    </div>
</header>

{{--modal tra cuu--}}
<div
    class="modal fade"
    id="formModal"
    tabindex="-1"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 text-end">
                        <img
                            src="{{asset('frontend/assets/image/close.png')}}"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                            alt="Close"
                            class="btn-modal-close"
                            width="40"
                        />
                    </div>
                    <div class="col-12 text-center">
                        <img src="{{asset('frontend/assets/image/logo.png')}}" width="255" />
                    </div>
                    <div class="col-12">
                        <div class="input-group mb-3 mt-3 relative-active">
                            <input class="input-result" name="cccd" placeholder="Căn cước công dân*"/>
                            <span id="txtCccd"></span>
                        </div>
                    </div>
                    <div class="col-12">
                        <button
                            type="button"
                            id="btnTracuu"
                            class="btn btn-result"
                            data-url="{{route('ajax.result.admissions.get')}}"
                        >
                            Xác nhận gửi
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{--Modal trả kết quả--}}
<!-- Modal -->
<div
    class="modal fade "
    id="resultModal"
    tabindex="-1"
    aria-labelledby="resultModalLabel"
    aria-hidden="true"
>
    <div class="modal-dialog modal-result modal-xl">
        <div class="modal-content">
            <div class="modal-body position-relative">
                <div class="row">
                    <div class="col-12 text-end">
                        <img
                            src="{{asset('frontend/assets/image/close.png')}}"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                            alt="Close"
                            class="btn-modal-close"
                            width="40"
                        />
                    </div>
                    <div class="col-12 text-center">
                        <h2>
                            {!! $setting['site_p_description_'.$lang] !!}
                        </h2>
                    </div>
                    <div class="col-12">
                        <div id="frmResult" class="form-result">
                            <div class="table-responsive">
                                    <table class="table-content">
                                        <tbody>
                                        <tr>
                                            <td style="width: 100px;">
                                                <label
                                                >Thí sinh:
                                                </label>
                                            </td>
                                            <td>
                                                <strong id="resultName">Nguyễn Việt Dũng</strong>
                                            </td>
                                            <td style="width: 100px;">
                                                <label>Giới tính:</label>
                                            </td>
                                            <td>
                                                <strong id="resultGender">Nữ</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Sinh ngày: </label>
                                            </td>
                                            <td>
                                                <strong id="resultBirthday">29/09/1999</strong>
                                            </td>
                                            <td>
                                                <label>CMND/CCCD:</label>
                                            </td>
                                            <td>
                                                <strong id="resultCCCD">017305009518</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">
                                                <div id="contentPending">
                                                    {!! $setting['site_popup_pending'] !!}
                                                </div>
                                                <div id="contentApproved">
                                                    {!! $setting['site_contact_info_'.$lang] !!}
                                                </div>
                                                <div id="contentRejected">
                                                    {!! $setting['site_reject_info_'.$lang] !!}
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Số báo danh:</label>
                                            </td>
                                            <td>
                                                <strong id="resultManganh">7510406</strong>
                                            </td>
                                            <td>
                                                <label>Tên ngành:</label>
                                            </td>
                                            <td>
                                                <strong id="resultTennganh">Công nghệ kỹ thuật môi trường</strong>
                                            </td>
                                        </tr>

                                        <tr id="bangDiem">
                                            <table class="bangdiem-import">
                                                <tr>
                                                    <th colspan="2" id="pointOneName">...</th>
                                                    <th colspan="2" id="pointTwoName">...</th>
                                                    <th rowspan="2" id="">Tổng điểm xét tuyển (Đã bao gồm điểm ưu tiên nếu có)</th>
                                                </tr>
                                                <tr>
                                                    <td>Điểm gốc</td>
                                                    <td>Điểm ưu tiên</td>
                                                    <td>Điểm gốc</td>
                                                    <td>Điểm ưu tiên</td>

                                                </tr>
                                                <tr>
                                                    <td id="scoreOne">...</td>
                                                    <td id="PriorityOne">...</td>
                                                    <td id="scoreTwo">...</td>
                                                    <td id="priorityTwo">...</td>
                                                    <td id="totalPoint">...</td>
                                                </tr>
                                            </table>
                                        </tr>

                                        <tr>
                                            <td colspan="4">
                                                <p>Ghi chú: <span id="commentPoint">...</span></p>
                                            </td>
                                        </tr>


                                        @if($setting['banner_factory_vn']!='')
                                        <tr id="trNhaphoc">
                                            <td colspan="4">
                                                <strong class="me-3">Thời gian nhập học:</strong>
                                                {!! $setting['banner_factory_'.$lang] !!}
                                            </td>
                                        </tr>
                                        @endif
                                        @if($setting['site_footer_info_1_vn']!='')
                                        <tr id="trLuuy">
                                            <td colspan="4">
                                                <strong class="me-3">Lưu ý:</strong>
                                                <div class="note-admission">
                                                    {!! $setting['site_footer_info_1_'.$lang] !!}
                                                </div>
                                            </td>
                                        </tr>
                                        @endif

                                        </tbody>
                                    </table>
                            </div>
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>
</div>
