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
                    console.log(data);
                        if (data.data.length > 0) {
                            var html = '';
                            for (var i = 0; i < data.data.length; i++) {
                                let img = data.data[i].thumbnail;
                                let link = '/post/'+data.data[i].slug;
                                html += '<div class="col-md-12"><div class="card list-card"><a href="'+link+'"><div class="border-img"><img src="'+img+'" class="card-img-top" alt="" /></div><div  class="card-body"><h5 class="card-title">'+ data.data[i].name + '</h5><h6 class="card-subtitle mb-2 text-body-secondary">by <strong>'+data.data[i].author+'</strong></h6><p>'+ data.data[i].description + '</p></div></a></div></div>';
                            }
                            //append data with fade in effect
                            $('#items_container').append($(html).hide().fadeIn(1000));
                            $('#load_more_button').html('Load More');
                            $('#load_more_button').attr('disabled', false);
                            start = data.next;
                        } else {
                            $('#load_more_button').html('No More Data');
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
                            @if($data->banner!='')
                            <div class="item">
                                <img src="{{upload_url($data->banner)}}" alt="{{$data->name}}" />
                            </div>
                            @endif
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
                    <h1>{!! $setting['keyword_15_'.$lang] !!}</h1>
                    <form>
                        <input
                            type="text"
                            name="search"
                            placeholder="Tìm kiếm "
                            value="{{(request()->search)}}"
                            class="form-control"
                        />
                    </form>
                    <div class="d-flex flex-row mb-3 mt-3 flex-wrap">
                       @if($data->meta_tags!='')
                        {!! getTags(route('frontend::home'),'btn-outline-tag',$data->meta_tags) !!}
                        @endif
                    </div>
                </div>

                <div class="col-md-8">
                    @if($hotBlogCategory)
                    <div class="hot-content">
                        <div class="row">
                            <div class="col-md-6">
                                <a href="{{route('frontend::blog.detail.get',$hotBlogCategory->slug)}}">
                                    <img src="{{ ($hotBlogCategory->thumbnail!='') ? upload_url($hotBlogCategory->thumbnail) : asset('frontend/assets/image/no-image.png')}}"/>
                                </a>
                            </div>
                            <div class="col-md-6">
                                <h2>{{$hotBlogCategory->name}}</h2>
                                <h4>
                                    by <strong>{{($hotBlogCategory->user()->exists()) ? $hotBlogCategory->user->full_name : 'admin'}}</strong> - {{datetoString($hotBlogCategory->created_at)}}
                                </h4>
                                <p>
                                    {!! ($hotBlogCategory->description!='') ? cut_string($hotBlogCategory->description,200) : cut_string(strip_tags($hotBlogCategory->content),200) !!}
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
                    <div class="col-md-12">
                        <div class="card list-card">
                            <a href="{{route('frontend::blog.detail.get',$d->slug)}}">
                            <div class="border-img">
                                    <img src="{{ ($d->thumbnail!='') ? upload_url($d->thumbnail) : asset('frontend/assets/image/no-image.png')}}"
                                         class="card-img-top" alt="{{$d->name}}" />
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">
                                    {{cut_string($d->name,100)}}
                                </h5>

                                <h6 class="card-subtitle mb-2 text-body-secondary">
                                    by <strong>{{($d->user()->exists()) ? $d->user->full_name : 'admin'}}</strong> - {{datetoString($d->created_at)}}
                                </h6>

                                <p>
                                    {!! ($d->description!='') ? cut_string($d->description,150) : cut_string(strip_tags($d->content),150) !!}

                                </p>

                            </div>
                            </a>
                        </div>
                        @if(auth()->check())
                        <div class="edit-post-admin">
                            <a href="{{route('wadmin::post.edit.get',$d->id)}}" target="_blank"><i class="fa fa-edit"></i> Sửa bài viết</a>
                        </div>
                        @endif

                    </div>
                @endforeach

            </div>


            <div class="row">
                <div class="col text-center">
                    <button type="button" id="load_more_button" data-category="{{$data->id}}" data-page="{{ $post->currentPage() + 4 }}" class="btn btn-light btn-show">
                        Xem thêm
                    </button>
                </div>
            </div>


        </div>
    </section>
@endsection
