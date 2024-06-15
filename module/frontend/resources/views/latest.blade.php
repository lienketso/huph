<section id="news">
    <div class="container">
        <div class="row">
            <div class="col text-center">
                <h2 class="title-news-home">{!! $setting['keyword_8_'.$lang] !!}</h2>
            </div>
        </div>
        <div class="row">
            @foreach($latestBlog as $d)
                <div class="col-md-3">
                    <div class="card">
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
                </div>
            @endforeach

        </div>
        <div class="row">
            <div class="col text-center">
                <a href="{{route('frontend::blog.index.get','tin-tuc')}}" class="btn btn-light btn-show">Xem thêm</a>
            </div>
        </div>
    </div>

</section>
