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
@endsection
@section('content')

    <div class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ol class="breadcrumb">
                        <li><a href="{{route('frontend::home')}}">{{$setting['keyword_9_'.$lang]}}</a></li>
                        <li>Tìm kiếm</li>
                        <li>Có <strong>{{$data->count()}}</strong> bài viết được tìm thấy với từ khóa "<strong>{{$name}}</strong>"</li>
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
                        
              
                                @foreach($data as $d)
                                    @include('frontend::blog.templates.blog')
                                @endforeach
            

                    </div><!-- Block Technology end -->

                    <div class="paging">
                            {{$data->links()}}
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
