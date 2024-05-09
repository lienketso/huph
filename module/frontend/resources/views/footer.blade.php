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
                <h4>{!! $setting['keyword_9_'.$lang] !!}</h4>
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
<div class="fixed-bottom">
    <div class="sub-menu">
                <span
                ><a
                        class="nav-link"
                        href="javascript:void(0)"
                        id="result"
                        onclick="setSubActive(this,'result')"
                    >
                        <img
                            src="{{asset('frontend/assets/image/mobile/icon/result.png')}}"
                            class="deactive"
                            alt="Menu"
                        />
                        <img
                            src="{{asset('frontend/assets/image/mobile/icon/resulta.png')}}"
                            class="active"
                            alt="Menu"
                        /> </a
                    ></span>
        <span
        ><a class="nav-link" href="javascript:void(0)"  onclick="setSubActive(this,'info')" id="info">
                        <img
                            src="{{asset('frontend/assets/image/mobile/icon/info.png')}}"
                            class="deactive"
                            alt="Menu"
                        />
                        <img
                            src="{{asset('frontend/assets/image/mobile/icon/infoa.png')}}"
                            class="active"
                            alt="Menu"
                        /> </a
            ></span>
        <span
        ><a class="nav-link" href="javascript:void(0)"  onclick="setSubActive(this,'post')" id="post">
                        <img
                            src="{{asset('frontend/assets/image/mobile/icon/post.png')}}"
                            class="deactive"
                            alt="Menu"
                        />
                        <img
                            src="{{asset('frontend/assets/image/mobile/icon/posta.png')}}"
                            class="active"
                            alt="Menu"
                        /> </a
            ></span>
    </div>
    <ul class="nav nav-fill mobile flex-sm-row">
        <li class="nav-item">
            <a
                class="nav-link"
                href="javascript:void(0)"
                onclick="setActive(this)"
            >
                <img
                    src="{{asset('frontend/assets/image/mobile/icon/home.png')}}"
                    class="deactive"
                    alt="Trang chủ"
                />
                <img
                    src="{{asset('frontend/assets/image/mobile/icon/homea.png')}}"
                    class="active"
                    alt="Trang chủ"
                />
            </a>
        </li>
        <li class="nav-item">
            <a
                class="nav-link"
                href="javascript:void(0)"
                onclick="setActive(this)"
            >
                <img
                    src="{{asset('frontend/assets/image/mobile/icon/news.png')}}"
                    class="deactive"
                    alt="Tin tức"
                />
                <img
                    src="{{asset('frontend/assets/image/mobile/icon/newsa.png')}}"
                    class="active"
                    alt="Tin tức"
                />
            </a>
        </li>
        <li class="nav-item">
            <a
                class="nav-link fab"
                href="javascript:void(0)"
                onclick="setActive(this)"
                id="fab"
            >
                <img
                    src="{{asset('frontend/assets/image/mobile/icon/menu.png')}}"
                    class="deactive"
                    alt="Menu"
                />
                <img
                    src="{{asset('frontend/assets/image/mobile/icon/menua.png')}}"
                    class="active"
                    alt="Menu"
                />
            </a>
        </li>
        <li class="nav-item">
            <a
                class="nav-link"
                href="javascript:void(0)"
                onclick="setActive(this)"
            >
                <img
                    src="{{asset('frontend/assets/image/mobile/icon/introduce.png')}}"
                    class="deactive"
                    alt="Giới thiệu" />
                <img
                    src="{{asset('frontend/assets/image/mobile/icon/introducea.png')}}"
                    class="active"
                    alt="Giới thiệu"
                /></a>
        </li>
        <li class="nav-item">
            <a
                class="nav-link"
                href="javascript:void(0)"
                onclick="setActive(this)"
            >
                <img
                    src="{{asset('frontend/assets/image/mobile/icon/tranning.png')}}"
                    class="deactive"
                    alt="Các hệ đào tạo"
                />
                <img
                    src="{{asset('frontend/assets/image/mobile/icon/tranninga.png')}}"
                    class="active"
                    alt="Các hệ đào tạo"
                />
            </a>
        </li>
    </ul>
</div>
