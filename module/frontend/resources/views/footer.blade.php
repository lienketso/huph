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
                <h4>Link nhanh</h4>
                <ul class="list-group list-custom">
                    @foreach($quicklinks as $d)
                    <li class="list-group-item"><a href="{{$d->link}}">{{$d->name}}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-3">
                <h4>Liên hệ</h4>
                <ul class="list-group list-custom">
                    <li class="list-group-item">
                        {{$setting['site_hotline_'.$lang]}}
                        <br />
                        {{$setting['site_email_'.$lang]}}
                    </li>
                </ul>
            </div>
            <div class="col-md-3">
                <h4>Liên hệ</h4>
                <ul class="list-group list-custom">
                    <li class="list-group-item">
                        {{$setting['site_address_'.$lang]}}
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>
