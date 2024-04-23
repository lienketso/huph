@extends('frontend::master')
@section('content')
<div class="page-title">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{route('frontend::home')}}">{{$setting['keyword_9_'.$lang]}}</a></li>
					<li class="breadcrumb-item active" aria-current="page">{{cut_string($data->name,100)}}</li>
				</ol>
			</div><!-- Col end -->
		</div><!-- Row end -->
	</div><!-- Container end -->
</div><!-- Page title end -->
<section class="block-wrapper">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-md-12">

				<div class="single-post">

					<div class="post-title-area">
						<a class="post-cat" href="{{route('frontend::post.video.get')}}">Video</a>
						<h2 class="post-title">
							{{$data->name}}
						</h2>

					</div><!-- Post title end -->

					<div class="post-content-area">

						<div class="entry-content">
							<div class="entry-post">
								<div class="iframe-video-page">
									<iframe width="560" height="315" src="{{$data->description}}" title="{{$data->name}}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
								</div>
								<div class="content-video">
									{!! $data->content !!}
								</div>
							</div>

						</div>

						<!-- Entery content end -->
						@if(!is_null($data->tags))
						<div class="tags-area clearfix">
							<div class="post-tags">
								<span>Tags:</span>
								{{$data->tags}}
							</div>
						</div><!-- Tags end -->
						@endif

						<div class="share-items clearfix">
							<ul class="post-social-icons unstyled">
								<li class="facebook">
									<a target="_blank" href="http://www.facebook.com/sharer/sharer.php?u={{route('frontend::post.singlevideo.get',$data->slug)}}">
										<i class="fa fa-facebook"></i> <span class="ts-social-title">Facebook</span></a>
									</li>
									<li class="twitter">
										<a target="_blank" href="https://twitter.com/intent/tweet?text={{$data->name}}&url={{route('frontend::post.singlevideo.get',$data->slug)}}&via=Y Dược cổ truyền">
											<i class="fa fa-twitter"></i> <span class="ts-social-title">Twitter</span></a>
										</li>
										<li class="gplus">
											<a target="_blank" href="https://plus.google.com/share?url={{route('frontend::post.singlevideo.get',$data->slug)}}">
												<i class="fa fa-google-plus"></i> <span class="ts-social-title">Google +</span></a>
											</li>
											<li class="pinterest">
												<a target="_blank" href="https://pinterest.com/pin/create/button/?url={{route('frontend::post.singlevideo.get',$data->slug)}}&description={{$data->name}}&media={{upload_url($data->thumbnail)}}">
													<i class="fa fa-pinterest"></i> <span class="ts-social-title">Pinterest</span></a>
												</li>
											</ul>
										</div><!-- Share items end -->

									</div><!-- post-content end -->


									@if(!empty($related) && count($related))

									<div class="related-posts block">
										<h3 class="block-title"><span>{{$setting['keyword_13_'.$lang]}}</span></h3>

										<div id="latest-news-slide" class="owl-carousel owl-theme latest-news-slide">
											@foreach($related as $p)
											<div class="item">
												<div class="post-block-style clearfix">
													<div class="post-thumb">
														<a href="{{route('frontend::blog.detail.get',$p->slug)}}">
															<img class="img-fluid"
															src="{{ ($p->thumbnail!='') ? upload_url($p->thumbnail) : asset('admin/themes/images/no-image.png')}}"
															alt="{{$p->name}}" />
														</a>
													</div>
													<div class="post-content">
														<h2 class="post-title-relate title-medium">
															<a href="{{route('frontend::blog.detail.get',$p->slug)}}">{{$p->name}}</a>
														</h2>
														<div class="post-meta">
															<span class="post-author"><a href="#">{{$p->user->full_name}}</a></span>
															<span class="post-date">{{format_date($p->created_at)}}</span>
														</div>
													</div><!-- Post content end -->
												</div><!-- Post Block style end -->
											</div><!-- Item 1 end -->
											@endforeach
										</div><!-- Carousel end -->

									</div><!-- Related posts end -->
									@endif

								</div><!-- Single post end -->
							</div>



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



