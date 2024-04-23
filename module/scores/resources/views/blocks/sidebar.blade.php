@php
    $listRoute = [
        'wadmin::scores.index.get', 'wadmin::scores.create.get', 'wadmin::project.scores.get'
    ];

@endphp
@php
    use Illuminate\Support\Facades\Auth;
    $userLog = Auth::user();
    $roles = $userLog->load('roles.perms');
    $permissions = $roles->roles->first()->perms;
@endphp
@if ($permissions->contains('name','scores_index'))
    <li class="{{in_array(Route::currentRouteName(), $listRoute) ? 'active' : '' }}">
        <a href="{{route('wadmin::scores.index.get')}}"><i class="fa fa-anchor"></i> <span>Quản lý điểm thi</span></a></li>
@endif
