@extends('frontend::master')
@section('content')
    <section id="detail">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="detail-img">
                        <div class="title">
                            <h1>
                                {{$data->name}}
                            </h1>
                            <h4>by <span>{{($data->user()->exists()) ? $data->user->full_name : 'admin'}}</strong></span> - {{datetoString($data->created_at)}}</h4>
                            <div class="border-tag">
                                @if($data->categories()->exists())
                                    @foreach($data->categories as $c)
                                        <span class="badge rounded-pill text-bg-tag">{{$c->name}}</span>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <img src="{{($data->banner!='') ? upload_url($data->banner) : asset('frontend/assets/image/detail.png')}}"
                             width="100%" alt="{{$data->name}}" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="col-get-go">
                        <a href="{{route('frontend::home')}}" class="go-back"><i class="fa-solid fa-arrow-right-from-bracket"></i> Quay lại</a>
                        @if(auth()->check())
                            <a class="" href="{{route('wadmin::post.edit.get',$data->id)}}" target="_blank"><i class="fa fa-edit"></i> Sửa bài viết</a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-8">
                    <div class="content-blog-single">
                        {!! $data->content !!}
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if(!is_null($related))
    <section id="news">
        <div class="container">
            <h3 class="title-main-site">Các tin liên quan</h3>
            <div class="row">
                @foreach($related as $d)
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
                                {{cut_string($d->name,100)}}
                            </h5>
                            <h6 class="card-subtitle mb-2 text-body-secondary">
                                by <strong>{{($d->user()->exists()) ? $d->user->full_name : 'admin'}}</strong> - {{datetoString($d->created_at)}}
                            </h6>
                            <p>
                                {!! ($d->description!='') ? cut_string($d->description,150) : cut_string(strip_tags($d->content),150) !!}
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
            @endif


{{--            <div class="row">--}}
{{--                <div class="col text-center">--}}
{{--                    <button type="button" class="btn btn-light btn-show">--}}
{{--                        Xem thêm--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--            </div>--}}

        </div>
    </section>
    @endsection
