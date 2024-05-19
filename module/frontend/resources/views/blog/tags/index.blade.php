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
    <section id="news" class="tag-section">
        <div class="container">
            <h2 class="title-tags">Bài viết theo từ khóa</h2>
            <div class="row" id="items_container">
                @foreach($post as $d)
                    <div class="col-md-3">
                        <div class="card">
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


            <div class="row">
                <div class="col text-center">

                </div>
            </div>


        </div>
    </section>
@endsection
