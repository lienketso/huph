@extends('frontend::master')
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
                        Trường Đại học <br />
                        Y tế công cộng
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
        <img src="{{asset('frontend/assets/image/gt.png')}}" />
    </section>

    <section id="diagram">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h3>Lịch sử hình thành và phát triển</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <h6>
                        Placerat proin consectetur egestas morbi rutrum
                        suspendisse pretium sed. Diam libero mauris tempus
                        pellentesque in diam.
                    </h6>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="timeline">
                        <!--first-->
                        <div
                            class="timeline__event animated fadeInUp delay-3s timeline__event--type1"
                        >
                            <div class="timeline__event__icon">
                                <i class="fa-solid fa-person-running"></i>
                            </div>
                            <div class="timeline__event__date">
                                Năm 2020
                            </div>
                            <div class="timeline__event__content">
                                <div class="timeline__event__title">
                                    Tiêu đề 1
                                </div>
                                <div class="timeline__event__description">
                                    <p>
                                        Thực hiện luật Giáo dục Đại học sửa
                                        đổi, Trường Đại học Y tế công cộng
                                        đã chuyển sang cơ chế mới với sự ra
                                        đời và lãnh đạo của Hội đồng trường
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!--second-->
                        <div
                            class="timeline__event animated fadeInUp delay-2s timeline__event--type2"
                        >
                            <div class="timeline__event__icon">
                                <i class="fa-solid fa-person-running"></i>
                            </div>
                            <div class="timeline__event__date">
                                Năm 2021
                            </div>
                            <div class="timeline__event__content">
                                <div class="timeline__event__title">
                                    Tiêu đề 2
                                </div>
                                <div class="timeline__event__description">
                                    <p>
                                        Thực hiện luật Giáo dục Đại học sửa
                                        đổi, Trường Đại học Y tế công cộng
                                        đã chuyển sang cơ chế mới với sự ra
                                        đời và lãnh đạo của Hội đồng trường
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!--third-->

                        <div
                            class="timeline__event animated fadeInUp delay-1s timeline__event--type3"
                        >
                            <div class="timeline__event__icon">
                                <i class="fa-solid fa-person-running"></i>
                            </div>
                            <div class="timeline__event__date">
                                Năm 2022
                            </div>
                            <div class="timeline__event__content">
                                <div class="timeline__event__title">
                                    Tiêu đề 3
                                </div>
                                <div class="timeline__event__description">
                                    <p>
                                        Thực hiện luật Giáo dục Đại học sửa
                                        đổi, Trường Đại học Y tế công cộng
                                        đã chuyển sang cơ chế mới với sự ra
                                        đời và lãnh đạo của Hội đồng trường
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!--forth-->

                        <div
                            class="timeline__event animated fadeInUp timeline__event--type1"
                        >
                            <div class="timeline__event__icon">
                                <i class="fa-regular fa-flag"></i>
                            </div>
                            <div class="timeline__event__date">
                                Năm 2024
                            </div>
                            <div class="timeline__event__content">
                                <div class="timeline__event__title">
                                    Tiêu đề 3
                                </div>
                                <div class="timeline__event__description">
                                    <p>
                                        Thực hiện luật Giáo dục Đại học sửa
                                        đổi, Trường Đại học Y tế công cộng
                                        đã chuyển sang cơ chế mới với sự ra
                                        đời và lãnh đạo của Hội đồng trường
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col text-center">
                    <h2>Sơ đồ tổ chức</h2>
                    <h6 class="mb-5">
                        Placerat proin consectetur egestas morbi rutrum
                        suspendisse pretium sed. Diam libero mauris tempus
                        pellentesque in diam.
                    </h6>
                    <p><img src="{{asset('frontend/assets/image/image7.png')}}" alt="Sơ đồ tổ chức" /></p>
                </div>
            </div>
        </div>
    </section>

    @include('frontend::form')
    @include('frontend::partner')

@endsection
