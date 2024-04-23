@extends('frontend::master')
@section('content')
    <div class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ol class="breadcrumb">
                        <li><a href="{{route('frontend::home')}}">{{$setting['keyword_9_'.$lang]}}</a></li>
                        <li>Video</li>
                    </ol>
                </div><!-- Col end -->
            </div><!-- Row end -->
        </div><!-- Container end -->
    </div><!-- Page title end -->



    <section class="block-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">

                    <div class="block category-listing category-style2">
                                <div class="row">
                                @foreach($post as $d)
                                <div class="col-lg-4">
                                    <div class="item-video">
                                        <a href="{{route('frontend::post.singlevideo.get',$d->slug)}}" class="img-video">
                                            <img src="{{ ($d->thumbnail!='') ? upload_url($d->thumbnail) : asset('admin/themes/images/no-image.png')}}" alt="{{$d->name}}">
                                            <span class="icon-pay"><i class="fa fa-play"></i></span>
                                        </a>
                                        <h3><a href="{{route('frontend::post.singlevideo.get',$d->slug)}}">{{$d->name}}</a></h3>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                           

                    </div><!-- Block Technology end -->

                    <div class="paging">
                            {{$post->links()}}
                    </div>


                </div><!-- Content Col end -->

                <div class="col-lg-4 col-md-12">
                    @include('frontend::blocks.sidebar')

                    @if($catNewsBlog)
                    <div class="widget color-default">
                        <h3 class="block-title"><span>{{$setting['keyword_11_'.$lang]}} </span></h3>
                        <div class="category-blog">
                            <ul>
                                @foreach($catNewsBlog as $d)
                                <li><a href="{{route('frontend::blog.index.get',$d->slug)}}"><i class="fa fa-angle-right"></i> {{$d->name}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                        @endif
                </div><!-- Sidebar Col end -->

            </div><!-- Row end -->
        </div><!-- Container end -->
    </section><!-- First block end -->

@endsection
