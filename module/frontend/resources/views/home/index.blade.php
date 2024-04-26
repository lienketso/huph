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
                    <h2>Thông tin tuyển sinh</h2>
                    <div class="sologan">
                        Bạn đã <span> sẵn sàng</span> để trở thành 1
                        <span>thành viên của HUPH</span> chưa ?
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
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
                                    $postHome = $d->posts()->where('display', 1)->take(1)->get();
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
                                            <a href="{{route('frontend::blog.detail.get',$p->slug)}}">
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
                                            " Tham gia ngay với chúng tôi nào! "
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
        <div class="container">
            <div class="row">
                <div class="col">
                    <h5>{{$catTT->name}}</h5>
                    <h2>
                        <span>Nguyện vọng</span> của bạn là gì hãy cùng tìm
                        hiểu nào!
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
                    <h2>Khám phá Trường Đại học Y tế công cộng</h2>
                    <p>
                        {!! $pageAbout->description !!}
                    </p>
                    <a href="{{route('frontend::page.index.get',$pageAbout->slug)}}" class="show-more">Tìm hiểu thêm -></a>
                </div>
                <div class="col-md-6">
                    <div class="img-border">
                        <img src="{{ ($pageAbout->thumbnail!='') ? upload_url($pageAbout->thumbnail) : asset('frontend/assets/image/135.png')}}"
                             width="100%" alt="{{$pageAbout->name}}" />
                        <a href="javascript:void()" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <img src="{{asset('frontend/assets/image/136.png')}}" alt="play">
                        </a>
                    </div>

                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="iframe-video-home">
                                        <iframe width="100%" height="315" src="{{youtubeToembed($pageAbout->file_attach)}}?si=RSRlL8AMtaPzU-Qr&amp;controls=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col">
                    <img src="{{asset('frontend/assets/image/139.png')}}" width="100%" class="mt-3" />
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <img src="{{asset('frontend/assets/image/138.png')}}" width="100%" class="mt-3" />
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <img src="{{asset('frontend/assets/image/141.png')}}" width="100%" class="mt-3" />
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
                <h2>Tin tức nổi bật và các bài báo, học bổng</h2>
            </div>
        </div>
        <div class="row">
            @foreach($latestNews as $d)
            <div class="col-md-3">
                <div class="card">
                    <div class="border-img">
                        <div class="border-tag">
                            @if($d->categories()->exists())
                                @foreach($d->categories as $c)
                                    <span class="badge rounded-pill text-bg-tag">{{$c->name}}</span>
                                @endforeach
                            @endif

                        </div>
                        <a href="{{route('frontend::blog.detail.get',$d->slug)}}">
                            <img src="{{ ($d->thumbnail!='') ? upload_url($d->thumbnail) : asset('admin/themes/images/no-image.png')}}"
                                 class="card-img-top" alt="{{$d->name}}" /></a>
                    </div>

                    <div class="card-body">
                        <h5 class="card-title">
                            {{$d->name}}
                        </h5>

                        <h6 class="card-subtitle mb-2 text-body-secondary">
                            by <strong>{{($d->user()->exists()) ? $d->user->full_name : 'admin'}}</strong> - {{datetoString($d->created_at)}}
                        </h6>

                        <p>
                            {{cut_string($d->description,100)}}
                        </p>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
        <div class="row">
            <div class="col text-center">
                <button type="button" class="btn btn-light btn-show">Xem thêm</button>
            </div>
        </div>
    </div>

</section>
@endsection
