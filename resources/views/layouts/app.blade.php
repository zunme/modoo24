<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>모두이사</title>

  	<meta name=”robots” content=”index”>
	<meta property="og:site_name" content="@yield('meta_site_name', '모두이사' )" />
	<meta property="og:type" content="website"/>
	
	@if( empty($meta) )
	<meta property="og:title" content="우리집 이사, 청소엔 모두이사"/>
	<meta property="og:image" content="{{\URL::to('/images/default_og_image.jpg')}}">
	<meta property="og:description" content="정식허가업체정보, 후기, 평가등급을 한눈에 확인하고 무료 견적 비교하자"/>	
	<meta property="og:url" content="http://modoo24.net"/>
	<meta name="description" content="정식허가업체정보, 후기, 평가등급을 한눈에 확인하고 무료 견적 비교하자">
	@else
	<meta property="og:title" content="{{$meta->title}}" />
	<meta property="og:image" content="{{$meta->image}}" />
	<meta property="og:description" content="{{$meta->description}}" />
	<meta property="og:url" content="{{$meta->url}}" />
	<meta name="description" content="{{$meta->description}}">
	@endif
	
	<meta name="author" content="모두이사">
	<meta name="keywords" content="이사,포장이사,비대면이사,비대면">
	<meta name="format-detection" content="telephone=no, address=no, email=no">    
	
	<!-- Styles -->
	<link rel="shortcut icon" href="/modoo24.ico" />
	
    <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">
	@yield('css')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        모두이사 커뮤니티
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <!--li><a href="{{ route('register') }}">Register</a></li-->
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ secure_asset('js/app.js') }}"></script>
	@yield('js')
</body>
</html>
