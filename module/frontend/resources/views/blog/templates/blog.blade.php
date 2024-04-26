@extends('frontend::master')
@section('js')
    <script type="text/javascript" src="{{asset('admin/themes/lib/jquery-ui/jquery-ui.js')}}"></script>
@endsection
@section('js-init')
    <script type="text/javascript">
        //tooger search
        $(document).ready(function(){
            // $('#FormSearchCat').hide();
            $(".btnViewSearch").click(function(){
                $("#FormSearchCat").toggle();
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            var start = 16;

            $('#load_more_button').click(function(e) {
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
                        $('#load_more_button').html('Loading...');
                        $('#load_more_button').attr('disabled', true);
                    },
                    success: function(data) {

                        if (data.data.length > 0) {
                            var html = '';
                            for (var i = 0; i < data.data.length; i++) {
                                let img = data.data[i].thumbnail;
                                let imgUrl = '/uploads/'+img;
                                let link = '/post/'+data.data[i].slug;
                                html += '<div class="col-md-3"><div class="card"><div class="border-img"><a href="'+link+'"><img src="'+imgUrl+'" class="card-img-top" alt="" /></a></div><div  class="card-body"><h5 class="card-title">'+ data.data[i].name + '</h5><h6 class="card-subtitle mb-2 text-body-secondary">by <strong>Dung Nguyen</strong> - ngày 20 tháng 04 năm 2024</h6><p>'+ data.data[i].description + '</p></div></div></div>';
                            }
                            //append data with fade in effect
                            $('#items_container').append($(html).hide().fadeIn(1000));
                            $('#load_more_button').html('Load More');
                            $('#load_more_button').attr('disabled', false);
                            start = data.next;
                        } else {
                            $('#load_more_button').html('No More Data Available');
                            $('#load_more_button').attr('disabled', true);
                        }
                    }
                });
            });
        });
    </script>
@endsection
@section('content')

    @if(!is_null($data->banner) || $data->banner!='')
        <section id="carousel">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="owl-carousel owl-theme owl-top">
                            <div class="item">
                                <img src="{{upload_url($data->banner)}}" alt="{{$data->name}}" />
                            </div>
                            @if($data->banner_1!='')
                                <div class="item">
                                    <img src="{{upload_url($data->banner_1)}}" alt="{{$data->name}}" />
                                </div>
                            @endif
                            @if($data->banner_2!='')
                                <div class="item">
                                    <img src="{{upload_url($data->banner_2)}}" alt="{{$data->name}}" />
                                </div>
                            @endif
                            @if($data->banner_3!='')
                                <div class="item">
                                    <img src="{{upload_url($data->banner_3)}}" alt="{{$data->name}}" />
                                </div>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </section>
    @endif


    <section id="hot-new">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h1>TIN TỨC NỔI BẬT</h1>
                    <form>
                        <input
                            type="text"
                            name="search"
                            placeholder="Tìm kiếm "
                            class="form-control"
                        />
                    </form>
                    <div class="d-flex flex-row mb-3 mt-3 flex-wrap">
                        <div class="p-2">
                            <input
                                type="checkbox"
                                class="btn-check"
                                id="btn-check-1"
                                autocomplete="off"
                            />
                            <label class="btn btn-outline-tag" for="btn-check-1"
                            >Tin tức</label
                            >
                        </div>
                        <div class="p-2">
                            <input
                                type="checkbox"
                                class="btn-check"
                                id="btn-check-2"
                                autocomplete="off"
                            />
                            <label class="btn btn-outline-tag" for="btn-check-2"
                            >Bài báo</label
                            >
                        </div>
                        <div class="p-2">
                            <input
                                type="checkbox"
                                class="btn-check"
                                id="btn-check-3"
                                autocomplete="off"
                            />
                            <label class="btn btn-outline-tag" for="btn-check-3"
                            >Học bổng</label
                            >
                        </div>
                        <div class="p-2">
                            <input
                                type="checkbox"
                                class="btn-check"
                                id="btn-check-4"
                                autocomplete="off"
                            />
                            <label class="btn btn-outline-tag" for="btn-check-4"
                            >Công tác xã hội</label
                            >
                        </div>
                        <div class="p-2">
                            <input
                                type="checkbox"
                                class="btn-check"
                                id="btn-check-5"
                                autocomplete="off"
                            />
                            <label class="btn btn-outline-tag" for="btn-check-5"
                            >Kỹ thuật xét nghiệm</label
                            >
                        </div>
                        <div class="p-2">
                            <input
                                type="checkbox"
                                class="btn-check"
                                id="btn-check-6"
                                autocomplete="off"
                            />
                            <label class="btn btn-outline-tag" for="btn-check-6"
                            >Dinh dưỡng</label
                            >
                        </div>

                    </div>
                </div>

                <div class="col-md-8">
                    @if($hotBlogCategory)
                    <div class="hot-content">
                        <div class="row">
                            <div class="col-md-6">
                                <a href="{{route('frontend::blog.detail.get',$hotBlogCategory->slug)}}">
                                    <img src="{{ ($hotBlogCategory->thumbnail!='') ? upload_url($hotBlogCategory->thumbnail) : asset('admin/themes/images/no-image.png')}}"/>
                                </a>
                            </div>
                            <div class="col-md-6">
                                <h2>{{$hotBlogCategory->name}}</h2>
                                <h4>
                                    by <strong>Dung Nguyen</strong> - {{datetoString($hotBlogCategory->created_at)}}
                                </h4>
                                <p>
                                    {{cut_string($hotBlogCategory->description,100)}}
                                </p>
                                <div class="show-more"><a href="{{route('frontend::blog.detail.get',$hotBlogCategory->slug)}}">Xem thêm</a></div>
                            </div>
                        </div>
                    </div>
                    @else
                        <h4>Không có bài viết nổi bật nào !</h4>
                    @endif
                </div>
            </div>

        </div>
    </section>


    <section id="news">
        <div class="container">
            <div class="row" id="items_container">
                @foreach($post as $d)
                    <div class="col-md-3">
                        <div class="card">
                            <div class="border-img">
                                <div class="border-tag">
                                    @if($d->categories()->exists())
                                        @foreach($d->categories as $c)
                                            <span class="badge rounded-pill text-bg-tag">{{$c->name}}</span>
                                        @endforeach
                                    @endif

                                </div>
                                <a href="{{route('frontend::blog.detail.get',$d->slug)}}">
                                    <img src="{{ ($d->thumbnail!='') ? upload_url($d->thumbnail) : asset('admin/themes/images/no-image.png')}}"
                                         class="card-img-top" alt="{{$d->name}}" /></a>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">
                                    {{$d->name}}
                                </h5>

                                <h6 class="card-subtitle mb-2 text-body-secondary">
                                    by <strong>{{($d->user()->exists()) ? $d->user->full_name : 'admin'}}</strong> - {{datetoString($d->created_at)}}
                                </h6>

                                <p>
                                    {{cut_string($d->description,100)}}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

            <div class="row">
                <div class="col text-center">
                    <button type="button" id="load_more_button" data-category="{{$data->id}}" data-page="{{ $post->currentPage() + 1 }}" class="btn btn-light btn-show">
                        Xem thêm
                    </button>
                </div>
            </div>
        </div>
    </section>
@endsection
