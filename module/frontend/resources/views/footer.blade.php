<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <a href="#" title="footer">
                    <img
                        src="{{asset('frontend/assets/image/section.png')}}"
                        title="Trường Đại học Y tế Công cộng"
                    />
                </a>
            </div>
            <div class="col-md-3">
{{--                <h4>{!! $setting['keyword_9_'.$lang] !!}</h4>--}}
                <ul class="list-group list-custom">
                    @foreach($quicklinks as $d)
                    <li class="list-group-item"><a href="{{$d->link}}">{{$d->name}}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-3">
                <h4>{!! $setting['keyword_10_'.$lang] !!}</h4>
                <ul class="list-group list-custom">
                    <li class="list-group-item">
                        {{$setting['site_hotline_'.$lang]}}
                        <br />
                        {{$setting['site_email_'.$lang]}}
                    </li>
                </ul>
            </div>
            <div class="col-md-3">
                <h4>{!! $setting['keyword_11_'.$lang] !!}</h4>
                <ul class="list-group list-custom">
                    <li class="list-group-item">
                        {{$setting['site_address_'.$lang]}}
                    </li>
                </ul>
            </div>
        </div>
        <div class="row pdt50">
            <div class="col-lg-6">
                <div class="copyright-huph">
                    © {{date('Y')}} — Copyright
                </div>
            </div>
            <div class="col-lg-6">
                <div class="privacy-huph">
                    Privacy
                </div>
            </div>
        </div>
    </div>
</footer>

{{--<div class="fixed-bottom">--}}
{{--    @php--}}
{{--        $menuLeft = getMenuMobile('left');--}}
{{--        $menuRight= getMenuMobile('right');--}}
{{--        $menuTop= getMenuMobile('top');--}}
{{--    @endphp--}}
{{--    <div class="sub-menu">--}}
{{--                <span>--}}
{{--                    <a--}}
{{--                        class="nav-link"--}}
{{--                        href="javascript:void(0)"--}}
{{--                        data-bs-toggle="modal"--}}
{{--                        data-bs-target="#formModal"--}}
{{--                        id="result"--}}
{{--                        onclick="setSubActive(this,'result')">--}}
{{--                        <img--}}
{{--                            src="{{asset('frontend/assets/image/mobile/icon/result.png')}}"--}}
{{--                            class="deactive"--}}
{{--                            alt="Menu" />--}}
{{--                        <img--}}
{{--                            src="{{asset('frontend/assets/image/mobile/icon/resulta.png')}}"--}}
{{--                            class="active"--}}
{{--                            alt="Menu"/>--}}
{{--                    </a>--}}
{{--                </span>--}}
{{--        @foreach($menuTop as $key=>$d)--}}
{{--        <span>--}}
{{--            <a class="nav-link" href="{{$d->link}}"  onclick="setSubActive(this,'info')" id="{{($key==0) ? 'info' : 'post'}}">--}}
{{--                        <img--}}
{{--                            src="{{ ($d->thumbnail!='') ? upload_url($d->thumbnail) : asset('frontend/assets/image/mobile/icon/home.png')}}"--}}
{{--                            class="deactive"--}}
{{--                            alt="{{$d->name}}"--}}
{{--                        />--}}
{{--                        <img--}}
{{--                            src="{{asset('frontend/assets/image/mobile/icon/infoa.png')}}"--}}
{{--                            class="active"--}}
{{--                            alt="{{$d->name}}"--}}
{{--                        /> </a>--}}
{{--        </span>--}}
{{--        @endforeach--}}

{{--    </div>--}}
{{--    <ul class="nav nav-fill mobile flex-sm-row">--}}
{{--        @foreach($menuLeft as $d)--}}
{{--        <li class="nav-item">--}}
{{--            <a--}}
{{--                class="nav-link"--}}
{{--                href="{{$d->link}}"--}}
{{--                onclick="setActive(this)"--}}
{{--            >--}}
{{--                <img--}}
{{--                    src="{{ ($d->thumbnail!='') ? upload_url($d->thumbnail) : asset('frontend/assets/image/mobile/icon/home.png')}}"--}}
{{--                    class="deactive"--}}
{{--                    alt="{{$d->name}}"--}}
{{--                />--}}
{{--                <img--}}
{{--                    src="{{asset('frontend/assets/image/mobile/icon/homea.png')}}"--}}
{{--                    class="active"--}}
{{--                    alt="Trang chủ"--}}
{{--                />--}}
{{--            </a>--}}
{{--        </li>--}}
{{--        @endforeach--}}

{{--        <li class="nav-item">--}}
{{--            <a--}}
{{--                class="nav-link fab"--}}
{{--                href="javascript:void(0)"--}}
{{--                onclick="setActive(this)"--}}
{{--                id="fab"--}}
{{--            >--}}
{{--                <img--}}
{{--                    src="{{asset('frontend/assets/image/mobile/icon/menu.png')}}"--}}
{{--                    class="deactive"--}}
{{--                    alt="Menu"--}}
{{--                />--}}
{{--                <img--}}
{{--                    src="{{asset('frontend/assets/image/mobile/icon/menua.png')}}"--}}
{{--                    class="active"--}}
{{--                    alt="Menu"--}}
{{--                />--}}
{{--            </a>--}}
{{--        </li>--}}
{{--            @foreach($menuRight as $d)--}}
{{--                <li class="nav-item">--}}
{{--                    <a--}}
{{--                        class="nav-link"--}}
{{--                        href="{{$d->link}}"--}}
{{--                        onclick="setActive(this)"--}}
{{--                    >--}}
{{--                        <img--}}
{{--                            src="{{ ($d->thumbnail!='') ? upload_url($d->thumbnail) : asset('frontend/assets/image/mobile/icon/home.png')}}"--}}
{{--                            class="deactive"--}}
{{--                            alt="Giới thiệu" />--}}
{{--                        <img--}}
{{--                            src="{{asset('frontend/assets/image/mobile/icon/introducea.png')}}"--}}
{{--                            class="active"--}}
{{--                            alt="Giới thiệu"--}}
{{--                        /></a>--}}
{{--                </li>--}}
{{--            @endforeach--}}

{{--    </ul>--}}
{{--</div>--}}
