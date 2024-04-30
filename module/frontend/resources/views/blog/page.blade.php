@extends('frontend::master')
@section('js-init')
    <script type="text/javascript">
        $(document).ready(function () {
            var owl = $(".owl-vendor");
            owl.owlCarousel({
                items: 6,
                loop: true,
                margin: 10,
                autoplay: true,
                autoplayTimeout: 1000,
                autoplayHoverPause: true,
                autoWidth: true,
            });

            $(".owl-carousel").owlCarousel({
                items: 4,
                margin: 0,
                responsiveClass: true,
                nav: true,
                dots: false,
                navText: [
                    "<div class='nav-btn prev-slide'></div>",
                    "<div class='nav-btn next-slide'></div>",
                ],

            });
        });
    </script>
@endsection
@section('content')
    <section id="header-gioithieu">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="detail-img">
                        <div class="logo">
                            <img src="{{asset('frontend/assets/image/section.png')}}" alt="Logo huph"/>
                        </div>
                        <div class="title">
                            <h1>{{$data->name}}</h1>
                        </div>
                        <img src="{{ ($data->banner!='') ? upload_url($data->banner) : asset('frontend/assets/image/top-gt.jpg')}}" width="100%" alt="{{$data->name}}" />
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="gioithieu">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h1>
                        {!! $setting['keyword_12_'.$lang] !!}
                    </h1>
                </div>
                <div class="col-md-8">
                    <div class="content-page">
                    {!! $data->content !!}
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section id="section-img">
        <img src="{{ ($data->address!='') ? upload_url($data->address) : asset('frontend/assets/image/gt.png')}}" alt="{{$data->name}}" />
    </section>


    <section id="diagram">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h3>{!! $setting['keyword_13_'.$lang] !!}</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <h6>
                        {!! $setting['keyword_14_'.$lang] !!}
                    </h6>
                </div>
                <div class="col-md-6 timeline">
                        <span onclick="$('.prev-slide').click()"
                        ><img src="{{asset('frontend/assets/image/left.png')}}"
                            /></span>
                    <span onclick="$('.next-slide').click()"
                    ><img src="{{asset('frontend/assets/image/right.png')}}"
                        /></span>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="owl-carousel owl-theme timeline-show">
                        @foreach($historyList as $d)
                        <div class="item">
                            <h4>{{$d->name}}</h4>
                            <div class="separate"></div>
                            <p>
                                {!! $d->description !!}
                            </p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col text-center sodotochuc">
                    {!! $setting['site_top_name_'.$lang] !!}
                </div>
            </div>
        </div>
    </section>

    @include('frontend::form')
    @include('frontend::partner')

@endsection
