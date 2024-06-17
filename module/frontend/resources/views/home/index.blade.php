@extends('frontend::master')
@section('js-init')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.sl-ts-home').on('change',function (e){
               e.preventDefault();
                var selectedOption = $(this).find(':selected');
               let _this = $(e.currentTarget);
               let categoryid = _this.val();
               var parent = selectedOption.attr('data-parent');
                $.ajax({
                    url: "{{ route('ajax.load.tuyensinh.get') }}",
                    method: "GET",
                    data: {
                        categoryid
                    },
                    dataType: "json",
                    beforeSend: function() {

                    },
                    success: function(data) {
                        console.log(data);
                        if (data.length > 0) {
                            var html = '';
                            for (var i = 0; i < data.length; i++) {
                                let link = '/post/'+data[i].slug;
                                html += '<div class="item-news-ts"><p><a href="'+link+'">'+data[i].name+'</a></p><p class="date-ts">by <strong>'+data[i].author+'</strong></p></div>';
                            }
                            //append data with fade in effect
                            $('#TS_'+parent).html(html);

                        } else {

                        }
                    }
                });
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $(".owl-carousel").owlCarousel({
                items: 4,
                margin: 10,
                autoplay: false,
                loop: true,
                autoplayTimeout: 2000,
                autoplayHoverPause: true,
                responsiveClass: true,
                nav: true,
                dots: false,
                navText: [
                    "<div class='nav-btn prev-slide'><i class='fa-regular fa-circle-left fa-fw'></i></div>",
                    "<div class='nav-btn next-slide'><i class='fa-regular fa-circle-right fa-fw'></i></div>",
                ],
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 3
                    },
                    1000: {
                        items: 5
                    }
                }
            });
        });
    </script>
@endsection
@section('content')

    @if($gallery)
<section id="carousel">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="owl-carousel  owl-theme owl-top">
                    @foreach($gallery as $d)
                    <div class="item">
                        <a href="{{$d->link}}">
                            <img src="{{ ($d->thumbnail!='') ? upload_url($d->thumbnail) : asset('frontend/assets/image/Poster.png')}}" alt="" />
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
    @endif

    <section id="enrollment">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2>{{$setting['keyword_1_'.$lang]}}</h2>
                    <div class="sologan">
                        {!! $setting['keyword_2_'.$lang] !!}
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">


                    <nav id="nav-program-fix">
                        <div
                            class="nav nav-tabs"
                            id="nav-tab"
                            role="tablist"
                        >
                            @foreach($categoryTuyensinh as $key=>$d)
                            <button
                                class="nav-link {{($key==0) ? 'active' : ''}}"
                                id="tab-{{$d->id}}"
                                data-bs-toggle="tab"
                                data-bs-target="#nav-{{$d->id}}"
                                type="button"
                                role="tab"
                                aria-controls="nav-{{$d->id}}"
                                aria-selected="true"
                            >
                                {{$d->name}}
                            </button>
                            @endforeach
                        </div>
                    </nav>
                    <div class="clearfix"></div>
                    <div class="col">
                        <div class="tab-content" id="nav-tabContent-fix">
                            @foreach($categoryTuyensinh as $key=>$d)
                                @php
                                    $postHome = $d->posts()->orderBy('created_at','desc')->where('display', 2)->take(1)->get();
                                    $postLienquan = $d->posts()->orderBy('created_at','desc')->where('display', 1)->take(4)->get();
                                @endphp
                            <div
                                class="tab-pane fade {{($key==0) ? 'show active' : ''}}"
                                id="nav-{{$d->id}}"
                                role="tabpanel"
                                aria-labelledby="nav-{{$d->id}}-tab"
                                tabindex="0"
                            >
                                <div class="home-tab-1">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="list-item-ts-home">
                                                <div class="select-child-ts">
                                                    <select name="category" class="sl-ts-home">
                                                        <option value="">Chọn thông tin</option>
                                                        @if($d->childs()->exists())
                                                            @foreach($d->childs as $child)
                                                                <option data-parent="{{$d->id}}" value="{{$child->id}}">{{$child->name}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                                <div class="list-news-ts">
                                                    <h4>Các tin liên quan</h4>
                                                    <div class="bg-ts" id="TS_{{$d->id}}">
                                                        @foreach($postLienquan as $l)
                                                        <div class="item-news-ts">
                                                            <p><a href="{{route('frontend::blog.detail.get',$l->slug)}}">{{$l->name}}</a></p>
                                                            <p class="date-ts">by <strong>{{($l->user()->exists()) ? $l->user->full_name : 'admin'}}</strong></p>
                                                        </div>
                                                        @endforeach
                                                    </div>


                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            @foreach($postHome as $p)
                                                <div class="item-tuyen-sinh-home-fix">
                                                    <h4>Thông báo nổi bật</h4>
                                                    <div class="content">
                                                        <h3>
                                                            {{$p->name}}
                                                        </h3>

                                                        <div class="desc-ts-home">
                                                            {!! ($p->description!='') ? cut_string($p->description,600) : cut_string(strip_tags($p->content),600) !!}
                                                        </div>


                                                        <div class="let-go">
                                                            <a href="https://tuyensinhdaihoc.huph.edu.vn/" target="_blank">
                                                                <img src="{{asset('frontend/assets/image/btn-dang-ky.png')}}" alt="Đăng ký ứng tuyển huph">
                                                            </a>
                                                            <a href="{{route('frontend::blog.detail.get',$p->slug)}}" class="show-more"
                                                            >Xem thêm thông tin chi tiết
                                                                -></a>
                                                        </div>
                                                    </div>

                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                </div>
                            </div>
                            @endforeach


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if($catTT)
    <section id="package">
        <div class="img-bgg-package">
            <img src="{{asset('frontend/assets/image/logo3.png')}}">
        </div>
        <div class="container">
            <div class="row">
                <div class="col">
                    <h5>{{$catTT->name}}</h5>
                    <h2>
                        {!! $setting['keyword_4_'.$lang] !!}
                    </h2>
                </div>
            </div>
        </div>
        @if($catTT->posts()->exists())
            @php
                $postCat = $catTT->posts()->orderBy('id','desc')->where('status','active')->where('is_home',1)->take(10)->get();
            @endphp
        <div class="marquee">
{{--            <div class="marquee-content">--}}
{{--                @foreach($postCat as $d)--}}
{{--                <div class="marquee-item">--}}
{{--                    <figure class="item">--}}
{{--                        <div class="inner">--}}
{{--                            <a href="{{route('frontend::blog.detail.get',$d->slug)}}"><img--}}
{{--                                src="{{ ($d->thumbnail!='') ? upload_url($d->thumbnail) : asset('frontend/assets/image/no-image.png')}}"--}}
{{--                                data-src="{{ ($d->thumbnail!='') ? upload_url($d->thumbnail) : asset('frontend/assets/image/no-image.png')}}"--}}
{{--                                alt="{{$d->name}}"--}}
{{--                            />--}}
{{--                            </a>--}}
{{--                        </div>--}}

{{--                        <figcaption>--}}
{{--                            {{$d->name}}--}}
{{--                        </figcaption>--}}
{{--                    </figure>--}}
{{--                </div>--}}
{{--                @endforeach--}}

{{--            </div>--}}

            <div class="owl-carousel owl-program">
                @foreach($postCat as $d)
                    <div class="marquee-item">
                        <figure class="item">
                            <a href="{{route('frontend::blog.detail.get',$d->slug)}}">
                            <div class="inner">
                                <img
                                        src="{{ ($d->thumbnail!='') ? upload_url($d->thumbnail) : asset('frontend/assets/image/no-image.png')}}"
                                        data-src="{{ ($d->thumbnail!='') ? upload_url($d->thumbnail) : asset('frontend/assets/image/no-image.png')}}"
                                        alt="{{$d->name}}"
                                    />

                            </div>

                            <figcaption>
                                {{$d->name}}
                            </figcaption>
                            </a>
                        </figure>
                    </div>
                @endforeach
            </div>

        </div>
        @endif
    </section>
    @endif
    <section id="about" class="mt-5">
        <div class="container">
            <div class="row mb-1 mt-3">
                <div class="col">
                    <h5 class="text-center">{{$pageAbout->name}}</h5>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="info-about-home">
                        {!! $pageAbout->description !!}
                    </div>
                    <a href="{{route('frontend::page.index.get',$pageAbout->slug)}}" class="show-more">Tìm hiểu thêm -></a>
                </div>
                <div class="col-md-6">
                    <div class="right-top-1">
                        <img src="{{asset('frontend/assets/image/img-top-right.png')}}" class="img-top-right" alt="img top right"/>
                        <img src="{{asset('frontend/assets/image/logo-top-right.png')}}" class="img-logo-top-right" alt="logo-top-right"/>
                        <img src="{{asset('frontend/assets/image/best.png')}}" class="img-best" alt="best choice"/>
                        <div class="video-container" >
                            <video width="555" height="310">
                                <source src="{{asset('frontend/assets/video/video.mp4')}}" type="video/mp4" >
                                Your browser does not support the video tag.
                            </video>
                            <div class="video-control">
                                <img src="{{asset('frontend/assets/image/136.png')}}" alt="Play">
                            </div>

                        </div>
                    </div>

                </div>
            </div>

                <div class="row mt-5 mb-5">
                    <div class="col-lg-12 no-mobile">
                        <div class="section-about-home ">
                            {!! $setting['about_section_1_pc'] !!}
                        </div>
                    </div>
                    <div class="col-lg-12 no-mobile">
                        <div class="section-about-home">
                            {!! $setting['about_section_2_pc'] !!}
                        </div>
                    </div>
                    <div class="col-lg-12 no-mobile">
                        <div class="section-about-home">
                            {!! $setting['about_section_3_pc'] !!}
                        </div>
                    </div>

                    <div class="col-lg-12 no-desktop">
                        <div class="section-about-home ">
                            {!! $setting['about_section_1_mobile'] !!}
                        </div>
                    </div>
                    <div class="col-lg-12 no-desktop">
                        <div class="section-about-home">
                            {!! $setting['about_section_2_mobile'] !!}
                        </div>
                    </div>
                    <div class="col-lg-12 no-desktop">
                        <div class="section-about-home">
                            {!! $setting['about_section_3_mobile'] !!}
                        </div>
                    </div>

                </div>


        </div>
    </section>
{{--partner--}}
    @include('frontend::partner')
    @include('frontend::form')

<section id="news">
    <div class="container">
        <div class="row">
            <div class="col text-center">
                <h2 class="title-news-home">{!! $setting['keyword_8_'.$lang] !!}</h2>
            </div>
        </div>
        <div class="row">
            @foreach($latestNews as $d)
            <div class="col-md-3">
                <div class="card">
                    <a href="{{route('frontend::blog.detail.get',$d->slug)}}">
                    <div class="border-img">


                            <img src="{{ ($d->thumbnail!='') ? upload_url($d->thumbnail) : asset('frontend/assets/image/no-image.png')}}"
                                 class="card-img-top" alt="{{$d->name}}" />
                    </div>

                    <div class="card-body">
                        <h5 class="card-title">
                            {{cut_string($d->name,100)}}
                        </h5>

                        <h6 class="card-subtitle mb-2 text-body-secondary">
                            by <strong>{{($d->user()->exists()) ? $d->user->full_name : 'admin'}}</strong>
                        </h6>

                        <p>
                            {!! ($d->description!='') ? cut_string($d->description,150) : cut_string(strip_tags($d->content),150) !!}
                        </p>
                    </div>
                    </a>
                </div>
            </div>
            @endforeach

        </div>
        <div class="row">
            <div class="col text-center">
                <a href="{{route('frontend::blog.index.get','tin-tuc')}}" class="btn btn-light btn-show">Xem thêm</a>
            </div>
        </div>
    </div>

</section>
@endsection
