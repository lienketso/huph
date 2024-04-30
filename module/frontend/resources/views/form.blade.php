<section id="contact">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1>
                    {!! $setting['keyword_7_'.$lang] !!}
                </h1>
            </div>
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        placeholder="Họ và tên*"
                        aria-label="Họ và tên"
                    />
                    <span id="txtName"></span>
                </div>
                <div class="input-group mb-3">
                    <input
                        type="text"
                        name="phone"
                        class="form-control"
                        placeholder="Số điện thoại*"
                        aria-label="Họ và tên"
                    />
                    <span id="txtPhone"></span>
                </div>
                <div class="input-group mb-3">
                    <button
                        id="btnForm"
                        data-url="{{route('ajax.submit.form.get')}}"
                        type="button"
                        class="btn btn-confirm form-control btn-confirm"
                    >
                        Xác nhận gửi
                    </button>
                </div>

                <div id="successForm">
                    Gửi tin nhắn thành công
                </div>

            </div>
        </div>
    </div>
</section>
