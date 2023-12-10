<aside class="left-side-bar">
  <div class="brand-logo">
    <a href="{{route('home')}}">
      <img src="{{asset('assets/logo.jpg')}}" alt="{{env('APP_NAME')}}" class="dark-logo" />
      <span class="ml-2 text-uppercase" style="color: #000; font-weight: 800;">{{env('APP_NAME')}}</span>
    </a>
    <div class="close-sidebar" data-toggle="left-sidebar-close">
      <i class="ion-close-round"></i>
    </div>
  </div>
  <div class="menu-block customscroll">
    <div class="sidebar-menu">
      <ul id="accordion-menu">
        {{-- single page --}}
        <li>
          <a href="{{route('home')}}" class="dropdown-toggle no-arrow @if (Request::fullurl() == route('home')) active @endif">
            <span class="micon bi bi-house"></span><span class="mtext">{{__('home.home')}}</span>
          </a>
        </li>
        {{-- page with sub pages --}}
        <li class="dropdown">
          <a href="javascript:;" class="dropdown-toggle">
            <span class="micon bi bi-box-seam"></span><span class="mtext">{{__('products.title')}}</span>
          </a>
          <ul class="submenu">
            <li><a class="@if (Request::fullurl() == route('products.list')) active @endif" href="{{route('products.list')}}">{{__('products.list')}}</a></li>
            <li><a class="@if (Request::fullurl() == route('products.add')) active @endif" href="{{route('products.add')}}">{{__('products.add')}}</a></li>
          </ul>
        </li>
        {{-- categories sections --}}
        <li class="dropdown">
          <a href="javascript:;" class="dropdown-toggle">
            <span class="micon bi bi-box"></span><span class="mtext">{{__('category.categories')}}</span>
          </a>
          <ul class="submenu">
            <li><a class="@if (Request::fullurl() == route('categories.list')) active @endif" href="{{route('categories.list')}}">{{__('category.categories')}}</a></li>
            <li><a class="@if (Request::fullurl() == route('categories.add')) active @endif" href="{{route('categories.add')}}">{{__('category.add')}}</a></li>
          </ul>
        </li>
        {{-- categories sections --}}
        <li class="dropdown">
          <a href="javascript:;" class="dropdown-toggle">
            <span class="micon bi bi-receipt"></span><span class="mtext">{{__('sales.sales')}}</span>
          </a>
          <ul class="submenu">
            <li><a class="@if (Request::fullurl() == route('sales.new')) active @endif" href="{{route('sales.new')}}">{{__('sales.new')}}</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</aside>
<div class="mobile-menu-overlay"></div>