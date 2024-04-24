@if($data->cat_type=='post')
    @include('frontend::blog.templates.blog')
@endif
@if($data->cat_type=='tuyensinh')
    @include('frontend::blog.templates.addmission')
@endif
