@extends('frontend::master')
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
                    <div id="nav-program-mobile" class="dropdown" >
                        <button
                            class="btn btn-secondary dropdown-toggle"
                            type="button"
                            id="dropdownMenu2"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                        >
                            Đại học chính quy
                        </button>
                        <ul
                            class="dropdown-menu"
                            id="nav-tab"
                            role="tablist"
                            aria-labelledby="dropdownMenuButton1"
                        >
                            @foreach($categoryTuyensinh as $key=>$d)
                            <li
                                class="dropdown-item"
                                role="presentation"
                            >
                                <button
                                    class="nav-link {{($key==0)?'active':''}}"
                                    id="tab-{{$key}}"
                                    data-bs-toggle="tab"
                                    data-bs-target="#nav-{{$key}}"
                                    type="button"
                                    role="tab"
                                    aria-controls="nav-{{$key}}"
                                    aria-selected="true"
                                >
                                    {{$d->name}}
                                </button>
                            </li>
                            @endforeach

                        </ul>
                    </div>

                    <nav id="nav-program">
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
                        <div class="tab-content" id="nav-tabContent">
                            @foreach($categoryTuyensinh as $key=>$d)
                                @php
                                    $postHome = $d->posts()->orderBy('created_at','desc')->where('display', 1)->take(1)->get();
                                @endphp
                            <div
                                class="tab-pane fade {{($key==0) ? 'show active' : ''}}"
                                id="nav-{{$d->id}}"
                                role="tabpanel"
                                aria-labelledby="nav-{{$d->id}}-tab"
                                tabindex="0"
                            >
                                <div class="home-tab-1">
                                    @foreach($postHome as $p)
                                        <div class="item-tuyen-sinh-home">
                                            <div class="logo-am">
                                                <img src="{{asset('frontend/assets/image/am-ban.png')}}" alt="Logo âm bản">
                                            </div>
                                                <a class="img-hot-new" href="{{route('frontend::blog.detail.get',$p->slug)}}">
                                                    <img src="{{ ($p->thumbnail!='') ? upload_url($p->thumbnail) : asset('admin/themes/images/no-image.png')}}" />
                                                </a>
                                                <div class="content">
                                                    <h1>
                                                        {{$p->name}}
                                                    </h1>
                                                    <p>
                                                       {!! cut_string($p->description,300) !!}
                                                    </p>
                                                    <a href="{{route('frontend::blog.index.get',$d->slug)}}" class="show-more"
                                                    >Xem thêm các tin liên quan
                                                        -></a>
                                                </div>
                                            <div class="let-go">
                                                " {!! $setting['keyword_3_'.$lang] !!} "
                                            </div>
                                        </div>
                                    @endforeach
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
        <div class="marquee">
            <div class="marquee-content">
                @foreach($catTT->posts as $d)
                <div class="marquee-item">
                    <figure class="item">
                        <div class="inner">
                            <a href="{{route('frontend::blog.detail.get',$d->slug)}}"><img
                                src="{{ ($d->thumbnail!='') ? upload_url($d->thumbnail) : asset('admin/themes/images/no-image.png')}}"
                                data-src="{{ ($d->thumbnail!='') ? upload_url($d->thumbnail) : asset('admin/themes/images/no-image.png')}}"
                                alt="{{$d->name}}"
                            />
                            </a>
                        </div>

                        <figcaption>
                            {{$d->name}}
                        </figcaption>
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
                <h2>{!! $setting['keyword_8_'.$lang] !!}</h2>
            </div>
        </div>
        <div class="row">
            @foreach($latestNews as $d)
            <div class="col-md-3">
                <div class="card">
                    <a href="{{route('frontend::blog.detail.get',$d->slug)}}">
                    <div class="border-img">
                        <div class="border-tag">
                            @if($d->categories()->exists())
                                @foreach($d->categories as $c)
                                    <span class="badge rounded-pill text-bg-tag">{{$c->name}}</span>
                                @endforeach
                            @endif

                        </div>

                            <img src="{{ ($d->thumbnail!='') ? upload_url($d->thumbnail) : asset('admin/themes/images/no-image.png')}}"
                                 class="card-img-top" alt="{{$d->name}}" />
                    </div>

                    <div class="card-body">
                        <h5 class="card-title">
                            {{cut_string($d->name,100)}}
                        </h5>

                        <h6 class="card-subtitle mb-2 text-body-secondary">
                            by <strong>{{($d->user()->exists()) ? $d->user->full_name : 'admin'}}</strong> - {{datetoString($d->created_at)}}
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
