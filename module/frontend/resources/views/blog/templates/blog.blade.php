@php
    use Post\Models\PostMeta;
    $metaPost = PostMeta::where('post_id',$d->id)->get();
@endphp
<div class="post-block-style post-list clearfix">
    <div class="row">
        <div class="col-lg-4 col-md-6">
            <div class="post-thumb thumb-float-style">
                <a href="{{route('frontend::blog.detail.get',$d->slug)}}">
                    <img class="img-fluid"
                         src="{{ ($d->thumbnail!='') ? upload_url($d->thumbnail) : asset('admin/themes/images/no-image.png')}}"
                         alt="{{$d->name}}" />
                </a>

            </div>
        </div><!-- Img thumb col end -->

        <div class="col-lg-8 col-md-6">
            <div class="post-content">
                <h2 class="post-title title-large">
                    <a href="{{route('frontend::blog.detail.get',$d->slug)}}">{{$d->name}}</a>
                </h2>
                 @if(!empty($metaPost) && count($metaPost))
                <div class="row">
                    @foreach($metaPost as $da)
                @php
                    $val = json_decode($da->meta_value);
                @endphp
                <div class="col-lg-6">
                    <div class="item-meta-index">
                        <p><strong>{{$val->title}}</strong> : {{$val->name}}</p>
                    </div>
                </div>
                @endforeach
                </div>
                @else
                <p>{{cut_string($d->description,100)}}</p>
                @endif

                <a class="blog-more" href="{{route('frontend::blog.detail.get',$d->slug)}}">{{$setting['keyword_10_'.$lang]}} <i class="fa fa-angle-double-right"></i></a>
            </div><!-- Post content end -->
        </div><!-- Post col end -->
    </div><!-- 1st row end -->
</div><!-- 1st Post list end -->
