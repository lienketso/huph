@extends('frontend::master')
@section('js')

@endsection
@section('js-init')
    <script type="text/javascript">
        $(document).ready(function() {
            var start = 8;

            $('.btn_load_more').click(function(e) {
                e.preventDefault();
                let _this = $(e.currentTarget);
                let category = _this.attr('data-category');
                $.ajax({
                    url: "{{ route('frontend::blog.load-more.get',$data->slug) }}",
                    method: "GET",
                    data: {
                        start: start, category
                    },
                    dataType: "json",
                    beforeSend: function() {
                        $('#load_more_button_'+category).html('Loading...');
                        $('#load_more_button_'+category).attr('disabled', true);
                    },
                    success: function(data) {

                        if (data.data.length > 0) {
                            var html = '';
                            for (var i = 0; i < data.data.length; i++) {
                                let img = data.data[i].thumbnail;
                                let imgUrl = '/uploads/'+img;
                                let link = '/post/'+data.data[i].slug;
                                html += '<div class="col-md-3"><div class="card"><div class="border-img"><a href="'+link+'"><img src="'+img+'" class="card-img-top" alt="" /></a></div><div  class="card-body"><h5 class="card-title">'+ data.data[i].name + '</h5><h6 class="card-subtitle mb-2 text-body-secondary">by <strong>'+data.data[i].author +'</strong></h6><p>'+ data.data[i].description + '</p></div></div></div>';
                            }
                            //append data with fade in effect
                            $('#items_container_'+category).append($(html).hide().fadeIn(1000));
                            $('#load_more_button_'+category).html('Load More');
                            $('#load_more_button_'+category).attr('disabled', false);
                            start = data.next;
                        } else {
                            $('#load_more_button_'+category).html('No More Data Available');
                            $('#load_more_button_'+category).attr('disabled', true);
                        }
                    }
                });
            });
        });
    </script>
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

        });
    </script>
@endsection
@section('content')
<section id="header-tuyensinh">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="detail-img">
                    <div class="logo">
                        <img src="{{ asset('frontend/assets/image/section.png')}}" alt="logo huph"/>
                    </div>
                    <div class="title">
                        <h1>{{$data->name}}</h1>
                        <h5>{{$data->description}}</h5>
                    </div>
                    <img src="{{ ($data->banner!='') ? upload_url($data->banner) : asset('frontend/assets/image/section.png')}}" width="100%" />
                </div>
            </div>
        </div>
    </div>
</section>


@if($data->childs()->exists())
    <section class="child-category-page" id="enrollment">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="sologan mb-3">
                        <h1 class="title-tuyen-sinh">THÔNG TIN TUYỂN SINH</h1>
                        {!! $setting['keyword_2_'.$lang] !!}
                    </div>
                </div>
            </div>
            @foreach($data->childs as $child)
                <div class="row">
                    <div class="heading-nganh">
                        <span class="title-nganh-page">{{$child->name}}</span>
                        <div class="line-title-nganh">
                        </div>
                    </div>

                    <div class="con-lg-12">
                        <ul class="nav nav-tabs myTabNganh" id="" role="tablist">
                            @if($child->childs()->exists())
                                @foreach($child->childs as $key=>$c)
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link {{($key==0)?'active':''}}"
                                                id="home-tab{{$c->id}}" data-bs-toggle="tab"
                                                data-bs-target="#home-tab-pane{{$c->id}}"
                                                type="button" role="tab"
                                                aria-controls="home-tab-pane{{$c->id}}"
                                                aria-selected="true"><span>{{$c->name}}</span></button>
                                    </li>
                                @endforeach
                            @endif

                        </ul>
                        <div class="tab-content tab-content-nganh" id="">
                            @if($child->childs()->exists())
                                @foreach($child->childs as $key=>$c)
                                    @php
                                        $postsNganh = $c->posts()->where('status','active')->where('display','!=',2)->limit(4)->get();
                                        $postNoibat = $c->posts()->where('status','active')->where('display',2)->limit(1)->get();
                                    @endphp
                                    <div class="tab-pane fade {{($key==0)?'show active':''}}" id="home-tab-pane{{$c->id}}" role="tabpanel" aria-labelledby="home-tab{{$c->id}}"
                                         tabindex="{{$key}}">
                                        <div class="list-post-nganh">
                                            <div class="row">

                                                @if($c->childs()->exists())
                                                    @foreach($c->childs as $three)
                                                        <div class="col-lg-3">
                                                            <a class="item-post-nganh"
                                                               href="{{route('frontend::blog.index.get',$three->slug)}}"
                                                               style="background-image: url('{{($three->thumbnail!='') ? upload_url($three->thumbnail) : asset('frontend/assets/image/no-image.png')}}')">
                                                                <span>{{$three->name}}</span>
                                                            </a>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    @if($postNoibat)
                                                        @foreach($postNoibat as $p)
                                                            <div class="col-lg-12">
                                                                <div class="item-post-ts">
                                                                    <p><a href="{{route('frontend::blog.detail.get',$p->slug)}}">
                                                                            {{$p->name}}
                                                                        </a></p>
                                                                    <h6 class="card-subtitle mb-2 text-body-secondary">
                                                                        by <strong>{{($p->user()->exists()) ? $p->user->full_name : 'admin'}}</strong> - {{datetoString($p->created_at)}}
                                                                    </h6>
                                                                    @if(auth()->check())
                                                                        <div class="edit-post-admin-fix ts-edit">
                                                                            <a href="{{route('wadmin::tuyen-sinh.edit.get',$p->id)}}" target="_blank"><i class="fa fa-edit"></i> Sửa bài viết</a>
                                                                        </div>
                                                                    @endif
                                                                </div>

                                                            </div>
                                                        @endforeach
                                                    @endif
                                                    @foreach($postsNganh as $p)
                                                        <div class="col-lg-12">
                                                            <div class="item-post-ts">
                                                                <p><a href="{{route('frontend::blog.detail.get',$p->slug)}}">
                                                                        {{$p->name}}
                                                                    </a></p>
                                                                <h6 class="card-subtitle mb-2 text-body-secondary">
                                                                    by <strong>{{($p->user()->exists()) ? $p->user->full_name : 'admin'}}</strong> - {{datetoString($p->created_at)}}
                                                                </h6>
                                                                @if(auth()->check())
                                                                    <div class="edit-post-admin-fix ts-edit">
                                                                        <a href="{{route('wadmin::tuyen-sinh.edit.get',$p->id)}}" target="_blank"><i class="fa fa-edit"></i> Sửa bài viết</a>
                                                                    </div>
                                                                @endif
                                                            </div>

                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                @endforeach
                            @endif

                        </div>
                    </div>

                </div>
            @endforeach
        </div>
    </section>
@endif


@include('frontend::form')
@include('frontend::partner')

@endsection
