@php
    $listRoute = [
        'wadmin::report.index.get'
    ];

@endphp
@php
    use Illuminate\Support\Facades\Auth;
    $userLog = Auth::user();
    $roles = $userLog->load('roles.perms');
    $permissions = $roles->roles->first()->perms;
@endphp
@if ($permissions->contains('name','reports_index'))
    <li class="{{in_array(Route::currentRouteName(), $listRoute) ? 'active' : '' }}">
        <a href="{{route('wadmin::reports.index.get')}}"><i class="fa fa-calendar"></i> <span>Báo cáo</span></a></li>
@endif
