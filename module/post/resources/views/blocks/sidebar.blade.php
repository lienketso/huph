@php
    $listRoute = [
        'wadmin::post.index.get',
        'wadmin::post.create.get',
        'wadmin::post.edit.get',
        'wadmin::category.index.get',
        'wadmin::category.create.get',
        'wadmin::category.edit.get',
        'wadmin::tuyen-sinh.index.get',
        'wadmin::tuyen-sinh.create.get',
        'wadmin::cat-addmission.index.get',
        'wadmin::cat-addmission.create.get',
        'wadmin::cat-addmission.edit.get',
        'wadmin::comment.index.get'
    ];
    $indexRoute = ['wadmin::post.index.get'];
    $createRoute = ['wadmin::post.create.get'];
    $catRoute = ['wadmin::category.index.get','wadmin::category.create.get','wadmin::category.edit.get'];
    $catTSRoute = ['wadmin::cat-addmission.index.get','wadmin::cat-addmission.create.get','wadmin::cat-addmission.edit.get'];
    $indexProductRoute = ['wadmin::tuyen-sinh.index.get'];
    $createProductRoute = ['wadmin::tuyen-sinh.create.get'];
    $commentRoute = ['wadmin::comment.index.get'];
@endphp
@php
    use Illuminate\Support\Facades\Auth;
    $userLog = Auth::user();
    $roles = $userLog->load('roles.perms');
    $permissions = $roles->roles->first()->perms;
@endphp
@if ($permissions->contains('name','post_index'))
<li class="nav-parent {{in_array(Route::currentRouteName(), $listRoute) ? 'nav-active active' : '' }}">
    <a href="" ><i class="fa fa-newspaper-o"></i> <span>Bài viết</span></a>
    <ul class="children">
        <li class="{{in_array(Route::currentRouteName(), $catRoute) ? 'active' : '' }}">
            <a href="{{route('wadmin::category.index.get')}}">Danh mục tin tức</a></li>
        <li class="{{in_array(Route::currentRouteName(), $indexRoute) ? 'active' : '' }}">
            <a href="{{route('wadmin::post.index.get')}}">Danh sách tin tức</a></li>
        <li class="{{in_array(Route::currentRouteName(), $createRoute) ? 'active' : '' }}">
            <a href="{{route('wadmin::post.create.get')}}">Thêm tin tức</a></li>
        <li class="{{in_array(Route::currentRouteName(), $catTSRoute) ? 'active' : '' }}">
            <a href="{{route('wadmin::cat-addmission.index.get')}}">Danh mục tuyển sinh</a></li>
        <li class="{{in_array(Route::currentRouteName(), $indexProductRoute) ? 'active' : '' }}">
            <a href="{{route('wadmin::tuyen-sinh.index.get')}}">Danh sách tuyển sinh</a></li>
        <li class="{{in_array(Route::currentRouteName(), $createProductRoute) ? 'active' : '' }}">
            <a href="{{route('wadmin::tuyen-sinh.create.get')}}">Thêm tuyển sinh</a></li>
        <li class="{{in_array(Route::currentRouteName(), $commentRoute) ? 'active' : '' }}">
            <a href="{{route('wadmin::comment.index.get')}}">Mục cảm nhận </a></li>
    </ul>
</li>
@endif
