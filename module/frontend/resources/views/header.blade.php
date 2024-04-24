@php
    $menus = getAllmenu();
@endphp
<header class="py-2 mb-2">
    <div class="container d-flex flex-wrap justify-content-center hot-line">
        <a
            href="{{route('frontend::home')}}"
            class="d-flex align-items-center mb-3 mb-lg-0 me-lg-auto link-body-emphasis text-decoration-none"
        >
            <img src="{{($setting['site_logo']!='') ? upload_url($setting['site_logo']) : asset('frontend/assets/image/logo.png')}}" width="175" />
        </a>
        <span class="me-3">
          <i class="fa-solid fa-location-dot"></i> {{$setting['site_address_'.$lang]}}
        </span>
        <span>
          <i class="fa-solid fa-phone"></i>
          <a href="tel:{{str_replace(' ','',$setting['site_hotline_'.$lang])}}"> {{$setting['site_hotline_'.$lang]}}</a>
        </span>
    </div>
    <div class="container">
        <nav class="nav navbar nav-fill snip1135">
            @foreach($menus as $key=>$menu)
                <a class="nav-link {{ (request()->is($menu->link)) ? 'active' : '' }}" aria-current="page" href="{{$menu->link}}"
                >
                    @if($menu->thumbnail!='')
                        <img src="{{upload_url($menu->thumbnail)}}" alt="{{$menu->name}}">
                    @endif
                        {{$menu->name}}</a
                >
            @endforeach

        </nav>
    </div>
</header>
