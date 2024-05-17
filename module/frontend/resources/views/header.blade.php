@php
    $menus = getAllmenu();
@endphp
<header class="py-2 mb-2 fixed-header desktop">
    <div class="container d-flex flex-wrap justify-content-center hot-line">
        <a
            href="{{route('frontend::home')}}"
            class="d-flex align-items-center mb-3 mb-lg-0 me-lg-auto link-body-emphasis text-decoration-none"
        >
            <img src="{{($setting['site_logo']!='') ? upload_url($setting['site_logo']) : asset('frontend/assets/image/logo.png')}}" width="175" />
        </a>
        <span class="me-3">
          <i class="fa-solid fa-location-dot"></i> {{$setting['site_address_'.$lang]}}
        </span>
        <span>
          <i class="fa-solid fa-phone"></i>
          <a href="tel:{{str_replace(' ','',$setting['site_hotline_'.$lang])}}"> {{$setting['site_hotline_'.$lang]}}</a>
        </span>
    </div>
    <div class="container">
        <nav class="nav navbar nav-fill snip1135">

            @foreach($menus as $key=>$menu)
                @if(count($menu->childs))
                    <li class="nav-item dropdown">
                        <a href="{{$menu->link}}" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"> @if($menu->thumbnail!='')
                                <i class="{{$menu->thumbnail}}"></i>@endif
                            {{$menu->name}}</a>
                        <div class="dropdown-menu">
                            @foreach($menu->childs as $c)
                            <a href="{{$c->link}}" class="dropdown-item">{{$c->name}}</a>
                            @endforeach
                        </div>
                    </li>
                @else
                <a class="nav-link item-menu" aria-current="" href="{{$menu->link}}">
                    @if($menu->thumbnail!='')
                        <i class="{{$menu->thumbnail}}"></i>
                    @endif
                        {{$menu->name}}</a>
                @endif
               @endforeach

                <a
                    class="nav-link"
                    href="#"
                    data-bs-toggle="modal"
                    data-bs-target="#formModal"
                ><i class="fa-regular fa-calendar-check"></i>Kết quả
                    tuyển sinh</a>




        </nav>

    </div>
</header>

<header class="fixed-header mobile">
    <div class="container">
        <div class="row">
            <div class="col-6 mt-2 text-center">
                <a href="/" class="">
                    <img src="{{asset('frontend/assets/image/logo.svg')}}" width="512" />
                </a>
            </div>
            <div class="col-6 mt-2">
{{--                <div class="phone">--}}
{{--                    <i class="fa-solid fa-phone"></i>--}}
{{--                    <a href="tel:{{str_replace(' ','',$setting['site_hotline_'.$lang])}}"> {{$setting['site_hotline_'.$lang]}}</a>--}}
{{--                </div>--}}
{{--                <div class="addr mb-3">--}}
{{--                    <i class="fa-solid fa-location-dot me-2"></i>{{$setting['site_address_'.$lang]}}--}}
{{--                </div>--}}
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
                                                <label>Mã ngành:</label>
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
                                        <tr>
                                            <td colspan="4">
                                                <strong class="me-3">Thời gian nhập học:</strong>
                                                {!! $setting['banner_factory_'.$lang] !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">
                                                <strong class="me-3">Lưu ý:</strong>
                                                <div class="note-admission">
                                                    {!! $setting['site_footer_info_1_'.$lang] !!}
                                                </div>
                                            </td>
                                        </tr>
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
