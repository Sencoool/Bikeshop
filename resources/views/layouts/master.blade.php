<!doctype html>
<html lang="en">
<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">

<title>@yield('title',"BikeShop | จำหน่ายอะไหล่จักรยานออนไลน์")</title>
<link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/font-awesome/css/all.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>{{-- โหลดอันแรกสุด --}}
{{-- asset laravel runs into public --}}
<link rel="stylesheet" href="{{ asset('vendor/toastr/toastr.min.css') }}">
<script src="{{ asset('vendor/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/angular.min.js') }}"></script>
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
</head> {{-- จะเรียกใช้ JQuery หลายอันไม มันพังหมดเลยเห้ย --}}
<body>

<nav class="navbar navbar-default navbar-static-top">
<div class="container">    
    <div class="navbar-header">
    <a class="navbar-brand" href="#">BikeShop</a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
    <ul class="nav navbar-nav">
    <li><a href="{{ URL::to('home') }}">หน้าแรก</a></li> @guest
    @else
   <li><a href="{{ URL::to('product') }}">ข้อมูลสินค้า </a></li>
    @if(Auth::user()->level === 'admin')
        <li><a href="{{ URL::to('category') }}">ข้อมูลประเภทสินค้า </a></li>
        <li><a href="{{ URL::to('/user') }}">ข้อมูลผู้ใช้</a></li>
    @elseif(Auth::user()->level === 'employee')
        <li><a href="{{ URL::to('category') }}">ข้อมูลประเภทสินค้า </a></li>
        <li><a href="{{ URL::to('/employee/order')}}">ข้อมูลการสั่งซื้อสินค้า</a></li>
    @endif
    @endguest
    </ul>
    <ul class="nav navbar-nav navbar-right"> @guest
        </span></a></li>
        <li><a href="{{ route('login') }}">ล็อกอิน</a></li>
        <li><a href="{{ route('register') }}">ลงทะเบียน</a></li>
         @else
        <li><a href="{{ URL::to('/cart/view')}}"><i class="fa fa-shopping-cart"></i> ตะกร้า
            <span class="label label-danger">
            @if (Session::has('cart_items'))
                {!! count(Session::get('cart_items')) !!}
            @else
                {{ count(array()) }}
            @endif
        <li><a href="#">{{ Auth::user()->name }} </a></li>
        <li><a class="dropdown-item" href=""
            onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">
             {{ __('ออกจากระบบ') }}
         </a>

         <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
             @csrf
         </form></li> @endguest
        </ul>
    </div>

</div>
</nav> @yield("content")
<!-- js -->
<script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
@if(session('msg'))
@if(session('ok'))
<script>toastr.success("{{ session('msg') }}")</script>
@else
<script>toastr.error("{{ session('msg') }}")</script>
@endif
@endif
</body>
</html>