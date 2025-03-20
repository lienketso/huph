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
            @foreach($data->childs as $child)
                @php
                    $postsParent = $child->posts()->where('status','active')->where('is_hot','!=',1)->limit(3)->get();
                @endphp
            <div class="row">
                <div class="heading-nganh">
                    <span class="title-nganh-page">{{$child->name}}</span>
                    <div class="line-title-nganh">
                    </div>
                </div>

                <div class="con-lg-12">
                    @if($child->childs()->exists())
                    <ul class="nav nav-tabs myTabNganh" id="" role="tablist">

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
                    </ul>
                    @endif
                    <div class="tab-content tab-content-nganh" id="">
                        @if($child->childs()->exists())

                            @foreach($child->childs as $key=>$c)
                                @php
                                    $postsNganh = $c->posts()->where('status','active')->where('is_hot','!=',1)->limit(3)->get();
                                    $postNoibat = $c->posts()->where('status','active')->where('is_hot',1)->limit(1)->get();
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
                                                            <div class="col-lg-3">
                                                                <a class="item-post-nganh"
                                                                   href="{{route('frontend::blog.detail.get',$p->slug)}}"
                                                                   style="background-image: url('{{($p->thumbnail!='') ? upload_url($p->thumbnail) : asset('frontend/assets/image/no-image.png')}}')">
                                                                    <span>{{cut_string($p->name,35)}}</span>
                                                                </a>
                                                                @if(auth()->check())
                                                                    <div class="edit-post-admin-fix">
                                                                        <a href="{{route('wadmin::post.edit.get',$p->id)}}" target="_blank"><i class="fa fa-edit"></i> Sửa bài viết</a>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                @foreach($postsNganh as $p)
                                                    <div class="col-lg-3">
                                                        <a class="item-post-nganh"
                                                           href="{{route('frontend::blog.detail.get',$p->slug)}}"
                                                           style="background-image: url('{{($p->thumbnail!='') ? upload_url($p->thumbnail) : asset('frontend/assets/image/no-image.png')}}')">
                                                            <span>{{cut_string($p->name,35)}}</span>
                                                        </a>
                                                        @if(auth()->check())
                                                            <div class="edit-post-admin-fix">
                                                                <a href="{{route('wadmin::post.edit.get',$p->id)}}" target="_blank"><i class="fa fa-edit"></i> Sửa bài viết</a>
                                                            </div>
                                                        @endif
                                                    </div>
                                                @endforeach
                                                        @if(count($postsNganh)>=3)
                                                            <div class="col-lg-12">
                                                                <div class="view-all-button">
                                                                    <a class="item-xem-tat-ca"
                                                                       href="{{route('frontend::blog.index.get',$c->slug)}}"
                                                                       style="">
                                                                        <span>Xem tất cả</span>
                                                                    </a>
                                                                </div>

                                                            </div>
                                                        @endif
                                            @endif
                                        </div>
                                    </div>

                                </div>
                            @endforeach

                            @else

                            <div class="post-parent">
                                <div class="list-post-nganh">
                                    <div class="row">
                                        @foreach($postsParent as $p)
                                            <div class="col-lg-3">
                                                <a class="item-post-nganh"
                                                   href="{{route('frontend::blog.detail.get',$p->slug)}}"
                                                   style="background-image: url('{{($p->thumbnail!='') ? upload_url($p->thumbnail) : asset('frontend/assets/image/no-image.png')}}')">
                                                    <span>{{cut_string($p->name,35)}}</span>
                                                </a>
                                                @if(auth()->check())
                                                    <div class="edit-post-admin-fix">
                                                        <a href="{{route('wadmin::post.edit.get',$p->id)}}" target="_blank"><i class="fa fa-edit"></i> Sửa bài viết</a>
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                        @if(count($postsParent)>=3)
                                            <div class="col-lg-3">
                                                <a class="item-post-nganh"
                                                   href="{{route('frontend::blog.index.get',$child->slug)}}"
                                                   style="">
                                                    <span>Xem tất cả</span>
                                                </a>

                                            </div>
                                            @endif
                                    </div>
                                </div>
                            </div>

                        @endif

                    </div>
                </div>

            </div>
            @endforeach
        </div>
    </section>
    @endif


@endsection
