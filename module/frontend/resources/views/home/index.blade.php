@extends('frontend::master')
@section('content')
<section id="carousel">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="owl-carousel  owl-theme owl-top">
                    <div class="item">
                        <img src="{{asset('frontend/assets/image/Poster.png')}}" alt="" />
                    </div>
                    <div class="item">
                        <img src="{{asset('frontend/assets/image/Poster.png')}}" alt="" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
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
        <div class="row">
            <div class="col">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button
                            class="nav-link active"
                            id="tab-1"
                            data-bs-toggle="tab"
                            data-bs-target="#nav-1"
                            type="button"
                            role="tab"
                            aria-controls="nav-1"
                            aria-selected="true"
                        >
                            Đại học chính quy
                        </button>
                        <button
                            class="nav-link"
                            id="tab-2"
                            data-bs-toggle="tab"
                            data-bs-target="#nav-2"
                            type="button"
                            role="tab"
                            aria-controls="nav-2"
                            aria-selected="false"
                        >
                            Đại học vừa làm vừa học
                        </button>
                        <button
                            class="nav-link"
                            id="tab-3"
                            data-bs-toggle="tab"
                            data-bs-target="#nav-3"
                            type="button"
                            role="tab"
                            aria-controls="nav-3"
                            aria-selected="false"
                        >
                            Sau đại học
                        </button>
                        <button
                            class="nav-link"
                            id="tab-4"
                            data-bs-toggle="tab"
                            data-bs-target="#nav-4"
                            type="button"
                            role="tab"
                            aria-controls="nav-5"
                            aria-selected="false"
                        >
                            Ngắn hạn
                        </button>
                    </div>
                </nav>
                <div class="col">
                    <div class="tab-content" id="nav-tabContent">
                        <div
                            class="tab-pane fade show active"
                            id="nav-1"
                            role="tabpanel"
                            aria-labelledby="nav-1-tab"
                            tabindex="0"
                        >
                            S
                        </div>
                        <div
                            class="tab-pane fade"
                            id="nav-2"
                            role="tabpanel"
                            aria-labelledby="nav-2-tab"
                            tabindex="0"
                        >
                            F
                        </div>
                        <div
                            class="tab-pane fade"
                            id="nav-3"
                            role="tabpanel"
                            aria-labelledby="nav-3-tab"
                            tabindex="0"
                        >
                            T
                        </div>
                        <div
                            class="tab-pane fade"
                            id="nav-4"
                            role="tabpanel"
                            aria-labelledby="nav-4-tab"
                            tabindex="0"
                        >
                            .Y.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="vendor">
    <div class="container">
        <div class="row">
            <div class="col text-center">
                <h2>Đối tác và nhà tài trợ quốc tế</h2>
            </div>
        </div>
    </div>
    <div class="owl-carousel owl-vendor owl-theme">
        <div class="item">
            <img src="{{asset('frontend/assets/image/04/partner01.png')}}" width="187" />
        </div>
        <div class="item">
            <img src="{{asset('frontend/assets/image/04/partner03-1.png')}}" width="187" />
        </div>
        <div class="item">
            <img src="{{asset('frontend/assets/image/04/partner06-1.png')}}" width="187" />
        </div>
        <div class="item">
            <img src="{{asset('frontend/assets/image/04/partner07-1.png')}}" width="187" />
        </div>
        <div class="item">
            <img src="{{asset('frontend/assets/image/04/partner09-1.png')}}" width="187" />
        </div>
        <div class="item">
            <img src="{{asset('frontend/assets/image/04/partner10-1.png')}}" width="187" />
        </div>
    </div>
</section>
<section id="contact">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1>CÒN CHỜ GÌ NỮA HÃY LIÊN HỆ NGAY
                    VỚI CHÚNG TÔI ĐỂ ĐƯỢC TƯ VẤN CÁC HUPHERS TƯƠNG LAI NHÉ!</h1>
            </div>
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Họ và tên*" aria-label="Họ và tên">
                </div>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Số điện thoại*" aria-label="Họ và tên">
                </div>
                <div class="input-group mb-3">
                    <button type="button" class="btn btn-confirm form-control btn-confirm "> Xác nhận gửi</button>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="news">
    <div class="container">
        <div class="row">
            <div class="col text-center">
                <h2>Tin tức nổi bật và các bài báo, học bổng</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <img src="{{asset('frontend/assets/image/card4.png')}}" class="card-img-top" alt="..." />
                    <div class="card-body">
                        <h5 class="card-title">
                            Sự chuyển mình mạnh mẽ của Công tác xã hội trong bệnh viện
                        </h5>
                        <h6 class="card-subtitle mb-2 text-body-secondary">
                            by Dung Nguyen - ngày 20 tháng 04 năm 2024
                        </h6>
                        <p>
                            Lorem Ipsum is simply dummy text of the printing
                            andtypesetting industry. Lorem Ipsum .......
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <img src="{{asset('frontend/assets/image/card2.png')}}" class="card-img-top" alt="..." />
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            Sự chuyển mình mạnh mẽ của Công tác xã hội trong bệnh viện
                        </h5>
                        <h6 class="card-subtitle mb-2 text-body-secondary">
                            by Dung Nguyen - ngày 20 tháng 04 năm 2024
                        </h6>
                        <p>
                            Lorem Ipsum is simply dummy text of the printing
                            andtypesetting industry. Lorem Ipsum .......
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <img src="{{asset('frontend/assets/image/card3.png')}}" class="card-img-top" alt="..." />
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            Sự chuyển mình mạnh mẽ của Công tác xã hội trong bệnh viện
                        </h5>
                        <h6 class="card-subtitle mb-2 text-body-secondary">
                            by Dung Nguyen - ngày 20 tháng 04 năm 2024
                        </h6>
                        <p>
                            Lorem Ipsum is simply dummy text of the printing
                            andtypesetting industry. Lorem Ipsum .......
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <img src="{{asset('frontend/assets/image/card4.png')}}" class="card-img-top" alt="..." />
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            Sự chuyển mình mạnh mẽ của Công tác xã hội trong bệnh viện
                        </h5>
                        <h6 class="card-subtitle mb-2 text-body-secondary">
                            by Dung Nguyen - ngày 20 tháng 04 năm 2024
                        </h6>
                        <p>
                            Lorem Ipsum is simply dummy text of the printing
                            andtypesetting industry. Lorem Ipsum .......
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col text-center">
                <button type="button" class="btn btn-light btn-show">Xem thêm</button>
            </div>
        </div>
    </div>

</section>
@endsection
