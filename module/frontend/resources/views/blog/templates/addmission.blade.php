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
<section id="enrollment">
    <div class="container mt-5">
        <div class="row ">
            <div class="col">
                <div class="sologan mb-3">
                    {!! $setting['keyword_2_'.$lang] !!}
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
                        @if($data->childs()->exists())
                            @foreach($data->childs as $key=>$child)
                                <button
                                    class="nav-link {{($key==0) ? 'active' : ''}}"
                                    id="tab-{{$child->id}}"
                                    data-bs-toggle="tab"
                                    data-bs-target="#nav-{{$child->id}}"
                                    type="button"
                                    role="tab"
                                    aria-controls="nav-{{$child->id}}"
                                    aria-selected="true"
                                >
                                    {{$child->name}}
                                </button>
                            @endforeach
                        @endif


                    </div>
                </nav>
                <div class="clearfix"></div>

                <div class="tab-content mt-3" id="nav-tabContent">
                    @if($data->childs()->exists())
                        @foreach($data->childs as $key=>$child)
                            @php
                                $postChild = $child->posts()->where('status','active')->paginate(8);
                            @endphp
                            <div
                                class="tab-pane fade {{($key==0) ? 'show active' : ''}}"
                                id="nav-{{$child->id}}"
                                role="tabpanel"
                                aria-labelledby="nav-{{$child->id}}-tab"
                                tabindex="0"
                            >
                                <div class="row" id="items_container_{{$child->id}}">
                                    @foreach($postChild as $d)
                                    <div class="col-md-3">
                                        <div class="card">
                                            <a href="{{route('frontend::blog.detail.get',$d->slug)}}">
                                            <div class="border-img">

                                                    <img
                                                        src="{{ ($d->thumbnail!='') ? upload_url($d->thumbnail) : asset('admin/themes/images/no-image.png')}}"
                                                        class="card-img-top"
                                                        alt="{{$d->name}}"
                                                    />

                                            </div>

                                            <div class="card-body">
                                                <h5 class="card-title">
                                                    {{cut_string($d->name,100)}}
                                                </h5>
                                                <h6
                                                    class="card-subtitle mb-2 text-body-secondary"
                                                >
                                                    by <strong>{{($d->user()->exists()) ? $d->user->full_name : 'admin'}}</strong> - {{datetoString($d->created_at)}}
                                                </h6>
                                                <p>
                                                    {!! ($d->description!='') ? cut_string($d->description,150) : cut_string(strip_tags($d->content),150) !!}
                                                </p>
                                            </div>
                                            </a>
                                        </div>
                                    </div>
                                    @endforeach

                                </div>

                                <div class="row">
                                    <div class="col text-center">
                                        <button
                                            type="button"
                                            class="btn btn-light btn-show btn_load_more"
                                            id="load_more_button_{{$child->id}}" data-category="{{$child->id}}" data-page="{{ $postChild->currentPage() + 4 }}"
                                        >
                                            Xem thêm
                                        </button>
                                    </div>
                                </div>


                            </div>
                        @endforeach
                    @endif

                </div>
            </div>
        </div>
    </div>
</section>

@include('frontend::form')
@include('frontend::partner')

@endsection
