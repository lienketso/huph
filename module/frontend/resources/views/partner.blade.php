{{--@if($partners)--}}
{{--<section id="vendor">--}}
{{--    <div class="container">--}}
{{--        <div class="row">--}}
{{--            <div class="col text-center">--}}
{{--                <h2>{!! $setting['keyword_6_'.$lang] !!}</h2>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="owl-carousel owl-vendor owl-theme">--}}
{{--        @foreach($partners as $d)--}}
{{--        <div class="item">--}}
{{--            <a href="{{$d->link}}" target="_blank">--}}
{{--                <img src="{{ ($d->thumbnail!='') ? upload_url($d->thumbnail) : asset('frontend/assets/image/04/partner01.png')}}"--}}
{{--                     width=""--}}
{{--                     alt="{{$d->name}}"--}}
{{--                />--}}
{{--            </a>--}}
{{--        </div>--}}
{{--        @endforeach--}}

{{--    </div>--}}
{{--</section>--}}
{{--@endif--}}

<section id="vendor">
    <div class="container">
        <div class="row">
            <div class="col text-center">
                <h2>{!! $setting['keyword_6_'.$lang] !!}</h2>
            </div>
        </div>
    </div>
<div class="slider-area">
    <div class="wrapper-slider">
        @foreach($partners as $d)
        <div class="item-partner">
            <a href="{{$d->link}}" target="_blank">
                <img alt="{{$d->name}}" src="{{ ($d->thumbnail!='') ? upload_url($d->thumbnail) : asset('frontend/assets/image/04/partner01.png')}}" />
            </a>
        </div>
        @endforeach
    </div>
</div>
</section>
