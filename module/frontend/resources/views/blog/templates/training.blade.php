@extends('frontend::master')
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

    @if($data->childs()->exists())
    <section class="child-category-page">
        <div class="container">
            <h1 class="title-dao-tao">GIỚI THIỆU VỀ CÁC NGÀNH ĐÀO TẠO</h1>
            <div class="row">
                @foreach($data->childs as $child)
                <div class="col-lg-4">
                    <div class="item-category-nganh">
                        <a href="{{route('frontend::blog.index.get',$child->slug)}}">{{$child->name}}</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <section id="news">
        <div class="container">
            <div class="row" id="items_container">
                @foreach($post as $d)
                    <div class="col-md-12">
                        <div class="card list-card">
                            <a href="{{route('frontend::blog.detail.get',$d->slug)}}">
                                <div class="border-img">
                                    <div class="border-tag">
                                        @if($d->categories()->exists())
                                            @foreach($d->categories as $c)
                                                <span class="badge rounded-pill text-bg-tag">{{$c->name}}</span>
                                            @endforeach
                                        @endif

                                    </div>

                                    <img src="{{ ($d->thumbnail!='') ? upload_url($d->thumbnail) : asset('admin/themes/images/no-image.png')}}"
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
                    </div>
                @endforeach

            </div>
        </div>
    </section>

    @include('frontend::form')
    @include('frontend::latest')
@endsection
