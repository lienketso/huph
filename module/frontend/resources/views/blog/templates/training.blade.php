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
                        <div class="tab-pane fade {{($key==0)?'show active':''}}" id="home-tab-pane{{$c->id}}" role="tabpanel" aria-labelledby="home-tab{{$c->id}}"
                             tabindex="{{$key}}">
                            @if($c->childs()->exists())
                            <div class="list-post-nganh">
                                <div class="row">
                                    @foreach($c->childs as $three)
                                    <div class="col-lg-3">
                                        <a class="item-post-nganh"
                                           href="{{route('frontend::blog.index.get',$three->slug)}}"
                                           style="background-image: url('{{($three->thumbnail!='') ? upload_url($three->thumbnail) : asset('admin/themes/images/no-image.png')}}')">
                                            <span>{{$three->name}}</span>
                                        </a>
                                    </div>
                                    @endforeach

                                </div>
                            </div>
                                @endif
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
    @include('frontend::latest')
@endsection
