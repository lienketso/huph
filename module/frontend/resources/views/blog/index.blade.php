@if($data->cat_type=='post')
    @include('frontend::blog.templates.blog')
@endif
@if($data->cat_type=='daotao')
    @include('frontend::blog.templates.training')
@endif
@if($data->cat_type=='tuyensinh' && $data->parent==0)
    @include('frontend::blog.templates.addmission')
@endif
