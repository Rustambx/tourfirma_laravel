<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Турфирма</title>
		<meta charset="utf-8">
		<meta name="format-detection" content="telephone=no" />
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.css" />
		<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" />
		<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
		<link rel="icon" href="{!! asset('media/images/favicon.ico') !!}">
		<link rel="shortcut icon" href="{!! asset('media/images/favicon.ico') !!}" />
		<link rel="stylesheet" href="{{asset('media/css/booking.css')}}">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="{{asset('media/css/camera.css')}}">
		<link rel="stylesheet" href="{{asset('media/css/owl.carousel.css')}}">
		<link rel="stylesheet" href="{{asset('media/css/form.css')}}">
		<link rel="stylesheet" href="{{asset('media/css/style.css')}}">
		<script src="{{asset('media/js/jquery.js')}}"></script>
		<script src="{{asset('media/js/jquery-migrate-1.2.1.js')}}"></script>
		<script src="{{asset('media/js/script.js')}}"></script>
		<script src="{{asset('media/js/superfish.js')}}"></script>
		<script src="{{asset('media/js/jquery.ui.totop.js')}}"></script>
		<script src="{{asset('media/js/jquery.equalheights.js')}}"></script>
		<script src="{{asset('media/js/jquery.mobilemenu.js')}}"></script>
		<script src="{{asset('media/js/jquery.easing.1.3.js')}}"></script>
		<script src="{{asset('media/js/owl.carousel.js')}}"></script>
		<script src="{{asset('media/js/camera.js')}}"></script>
		<!--[if (gt IE 9)|!(IE)]><!-->
		<script src="{{asset('media/js/jquery.mobile.customized.min.js')}}"></script>
		<!--<![endif]-->
		<script src="{{asset('media/js/jquery-ui-1.10.3.custom.min.js')}}"></script>
		<script src="{{asset('media/js/jquery.fancyform.js')}}"></script>
		<script src="{{asset('media/js/jquery.placeholder.js')}}"></script>
		<script src="{{asset('media/js/regula.js')}}"></script>
		<script src="{{asset('media/js/booking.js')}}"></script>
		<script src="{{asset('media/js/tabs.js')}}"></script>
		<!--[if lt IE 9]>
		<script src="{{asset('media/js/html5shiv.js')}}"></script>
		<link rel="stylesheet" media="screen" href="{{asset('media/css/ie.css')}}">
		<![endif]-->

		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.css" />
		<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" />
		<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>

	</head>
	<body @if(Route::currentRouteName() == 'index')class="page1" id="top"@endif>
<!--==============================header=================================-->

    @section('navigation')
        @include('navigation::list')
    @show

    @if(Route::currentRouteName() == 'index')
        @section('sliders')
            @include('slider::index')
        @show
    @endif

<!--==============================Content=================================-->
<div class="content">

	<div class="container_12">
		@if(Route::currentRouteName() != 'index')
			{{ Breadcrumbs::render() }}
		@endif

		@yield('content')


	</div>
</div>

<!--==============================footer=================================-->
		@yield('footer')

	</body>
</html>

