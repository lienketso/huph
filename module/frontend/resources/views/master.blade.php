<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{(isset($meta_title)) ? $meta_title : $setting['site_name_'.$lang]}}</title>
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@">
    <meta name="twitter:creator" content="@">
    <meta name="twitter:title" content="{{(isset($meta_title)) ? $meta_title : $setting['site_name_'.$lang]}}">
    <meta name="twitter:description" content="{{(isset($meta_desc)) ? $meta_desc : $setting['site_description_'.$lang]}}">
    <meta name="twitter:image" content="{{(isset($meta_thumbnail)) ? $meta_thumbnail : $setting['site_logo']}}">
    <meta name="description" content="{{(isset($meta_desc)) ? $meta_desc : $setting['site_description_'.$lang]}}" />
    <link rel="canonical" href="{{domain_url()}}" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="{{(isset($meta_title)) ? $meta_title : $setting['site_name_'.$lang]}}" />
    <meta property="og:description" content="{{(isset($meta_desc)) ? $meta_desc : $setting['site_description_'.$lang]}}" />
    <meta property="og:url" content="{{(isset($meta_url)) ? $meta_url : domain_url()}}" />
    <meta property="og:image" content="{{(isset($meta_thumbnail)) ? $meta_thumbnail : $setting['site_logo']}}" />
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
        crossorigin="anonymous"
    />
    <link href="{{asset('frontend/assets/fontawesome/css/fontawesome.css')}}" rel="stylesheet" />
    <link href="{{asset('frontend/assets/fontawesome/css/brands.css')}}" rel="stylesheet" />
    <link href="{{asset('frontend/assets/fontawesome/css/solid.css')}}" rel="stylesheet" />
    <!-- Owl Stylesheets -->
    <link
        rel="stylesheet"
        href="{{asset('frontend/assets/owlcarousel/dist/assets/owl.carousel.min.css')}}"
    />
    <link
        rel="stylesheet"
        href="{{asset('frontend/assets/style/custom.css')}}"/>
    <link
        rel="stylesheet"
        href="{{asset('frontend/assets/style/fix.css')}}"/>
    <link
        rel="stylesheet"
        href="{{asset('frontend/assets/owlcarousel/dist/assets/owl.theme.default.min.css')}}"
    />
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"
    ></script>
    <script
        src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
        crossorigin="anonymous"
    ></script>
    <script src="{{asset('frontend/assets/owlcarousel/dist/owl.carousel.min.js')}}"></script>
</head>
<body>
{{--header--}}
@include('frontend::header')

@yield('content')

@include('frontend::footer')
<script>
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

        var top = $(".owl-top");
        top.owlCarousel({
            items: 1,
            loop: true,
            margin: 10,
            autoplay: true,
            autoplayTimeout: 2000,
            autoplayHoverPause: true,
            autoWidth: false,
        });
    });


</script>

<script type="text/javascript">

    $('#successForm').hide();

    $('#btnForm').on('click',function(e){
       e.preventDefault();
       let _this = $(e.currentTarget);
       let url = _this.attr('data-url');
       let name = $('input[name="name"]').val();
       let phone = $('input[name="phone"]').val();
       let mess = '';
       if(name.length<=0){
           mess += 'error Name';
           $('#txtName').text('Họ tên bắt buộc nhập !');
       }else{
           $('#txtName').text('');
       }
       if(phone.length<=8 || phone.length>= 15){
            mess += 'error Phone';
            $('#txtPhone').text('Điện thoại bắt buộc nhập !');
       }else{
           $('#txtPhone').text('');
       }

       if(mess.length===0){
           $.ajax({
                   url: url,
                   type: "GET",
                   data: {
                       name: name,
                       phone: phone
                   },
                   success: function(response) {
                       $('#successForm').show(200);
                       $('input[name="name"]').val('');
                       $('input[name="phone"]').val('');
                   },
                   error: function(xhr, status, error) {
                       console.error(xhr.responseText); // Hiá»ƒn thá»‹ lá»—i náº¿u cĂ³
                   }
               });
       }
    });
</script>

@yield("js")
@yield("js-init")
@stack("js")
@stack("js-init")


<!-- script editor -->
@if($setting['site_script_info']!='')
    {!! $setting['site_script_info'] !!}
@endif

</body>
</html>
