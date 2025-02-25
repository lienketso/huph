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
        href="{{asset('frontend/assets/lib/bootstrap/css/bootstrap.min.css')}}"
        rel="stylesheet"

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
    <link rel="shortcut icon" type="image/png" href="{{asset('frontend/assets/image/favicon.png')}}"/>
    <script
        src="{{asset('frontend/assets/lib/bootstrap/js/bootstrap.bundle.min.js')}}"
    ></script>
    <script
        src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
        crossorigin="anonymous"
    ></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body>
{{--header--}}
@include('frontend::header')
<main role="main">
@yield('content')
</main>
@include('frontend::footer')
<script src="{{asset('frontend/assets/owlcarousel/dist/owl.carousel.min.js')}}"></script>
<script src="{{asset('frontend/assets/marquee/jquery.marquee.min.js')}}"></script>
<script src="{{asset('frontend/assets/lib/video/video.js')}}"></script>
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
            responsive: {
                0: {
                    items: 6
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 6
                }
            }
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
    //menu mobile
    function setActive(curent) {
        if (curent.classList.contains("active")) {
            $(curent).removeClass("active");
        } else {
            $(curent).addClass("active");
        }
        if (curent.classList.contains("active") && curent.id == "fab") {
            $(".sub-menu").addClass("active");
        } else {
            $(".sub-menu").removeClass("active");
        }
    }
    function setSubActive(curent,id) {
        if (curent.classList.contains("active")) {
            $(curent).removeClass("active");
        } else {
            $(curent).addClass("active");
        }
        $('.sub-menu .nav-link').not('#'+id).removeClass('active');
    }
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
                       phone: phone,
                   },
                   success: function(response) {
                       $('#successForm').show(200);
                       $('input[name="name"]').val('');
                       $('input[name="phone"]').val('');
                   },
                   error: function(xhr, status, error) {
                       console.error(xhr.responseText);
                   }
               });

       }
    });
</script>
{{--tra cứu kết quả--}}
<script type="text/javascript">
    $('#btnTracuu').on('click',function (e){
       e.preventDefault();
       let _this = $(e.currentTarget);
       let url = _this.attr('data-url');
       let cccd = $('input[name="cccd"]').val();
       let mess = '';
        if(cccd.length<=0){
            mess += 'error Name';
            $('#txtCccd').text('Số CCCD không hợp lệ !');
            $('input[name="cccd"]').focus();
        }else{
            $('#txtCccd').text('');
        }

        if(mess.length===0){
            $.ajax({
                url: url,
                type: "GET",
                data: {
                    cccd: cccd
                },
                success: function(response) {
                    console.log(response);
                    if(response==='404'){
                        $('#txtCccd').text('Thí sinh không có trên hệ thống !');
                    }else{
                        $('#formModal').modal('hide');
                        $('#resultModal').modal('show');
                        $('input[name="cccd"]').val('');
                        //add class
                        if(response.status==='approved'){
                            $('#frmResult').addClass('form-approved');
                            $('#frmResult').removeClass('form-rejected');
                            $('#contentApproved').show();
                            $('#contentRejected').hide();
                            $('#contentPending').hide();
                            $('.showPending').hide();
                            $('#trNhaphoc').show();
                            $('#trLuuy').show();
                        }
                        if(response.status==='pending'){
                            $('#frmResult').addClass('form-approved');
                            $('#frmResult').removeClass('form-rejected');
                            $('#contentPending').show();
                            $('#contentRejected').hide();
                            $('#contentApproved').hide();
                            $('#trNhaphoc').hide();
                            $('#trLuuy').hide();

                        }
                        if(response.status==='reject'){
                            $('#frmResult').addClass('form-rejected');
                            $('#frmResult').removeClass('form-approved');
                            $('#contentRejected').show();
                            $('#contentApproved').hide();
                            $('#contentPending').hide();
                            $('.showPending').hide();
                            $('#trNhaphoc').show();
                            $('#trLuuy').show();
                        }
                        //cho thêm vào các id nào
                        $('#resultName').text(response.name);
                        $('#resultBirthday').text(response.birthday);
                        $('#resultCCCD').text(response.cccd_number);
                        $('#resultManganh').text(response.identification_number);
                        $('#resultTennganh').text(response.test_subject);
                        $('#resultGender').text(response.gender);
                        //điểm
                        $('#pointOneName').text(response.score_one_name);
                        $('#pointTwoName').text(response.score_two_name);
                        $('#scoreOne').text(response.score_one);
                        $('#PriorityOne').text(response.priority_score_one);
                        $('#scoreTwo').text(response.score_two);
                        $('#priorityTwo').text(response.priority_score_two);
                        $('#totalPoint').text(response.total_scores);
                        $('#commentPoint').text(response.comment);
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }

    });
</script>

<script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function() {
        var currentUrls = window.location.href;
        var menuLinks = document.querySelectorAll('.nav-item a');
        menuLinks.forEach(function(link) {
            if (link.getAttribute('href') === currentUrls) {
                link.classList.add('active');
            }
        });

        const dropdownToggles = document.querySelectorAll('.dropdown-toggle');

        dropdownToggles.forEach(function (toggle) {
            toggle.addEventListener('click', function (event) {
                const isDropdownShown = this.nextElementSibling.classList.contains('show');
                if (!isDropdownShown) {
                    event.preventDefault();
                    const dropdown = new bootstrap.Dropdown(this);
                    dropdown.show();
                } else {
                    window.location.href = this.href;
                }
            });
        });

    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.navbar-toggler-mobile').on('click', function() {
            $('.navbar-collapse-mb').toggleClass('show');
        });

        $(document).on('click', function(event) {
            var $trigger = $(".navbar-toggler-mobile");
            if($trigger !== event.target && !$trigger.has(event.target).length){
                $(".navbar-collapse-mb").removeClass('show');
            }
        });

        // Dropdown toggle for nested menus
        $('.dropdown-submenu a.dropdown-toggle').on("click", function(e) {
            e.stopPropagation();
            e.preventDefault();
            $(this).next('.dropdown-menu').toggle();
            $(this).parent().siblings().find('.dropdown-menu').hide();
        });
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
