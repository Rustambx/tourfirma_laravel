<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Админ панель</title>
    <meta name="description" content="Админ панель">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="{{ asset(env('ADMIN_PUBLIC')) }}/admin/apple-icon.png">
    <link rel="shortcut icon" href="{{ asset(env('ADMIN_PUBLIC')) }}/admin/favicon.ico">

    <link rel="stylesheet" href="{{ asset(env('ADMIN_PUBLIC')) }}/admin/vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset(env('ADMIN_PUBLIC')) }}/admin/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset(env('ADMIN_PUBLIC')) }}/admin/vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="{{ asset(env('ADMIN_PUBLIC')) }}/admin/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="{{ asset(env('ADMIN_PUBLIC')) }}/admin/vendors/selectFX/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="{{ asset(env('ADMIN_PUBLIC')) }}/admin/vendors/jqvmap/dist/jqvmap.min.css">
    <link rel="stylesheet" href="{{ asset(env('ADMIN_PUBLIC')) }}/admin/vendors/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset(env('ADMIN_PUBLIC')) }}/admin/vendors/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css">

    <link rel="stylesheet" href="{{ asset(env('ADMIN_PUBLIC')) }}/admin/assets/css/style.css">
</head>

<body>


<!-- Left Panel -->
    @section('navigation')
        @include('admin.navigation')
    @show
<!-- /#left-panel -->

<!-- Left Panel -->

<!-- Right Panel -->

<div id="right-panel" class="right-panel">

    {{--<!-- Header-->
        @section('header')
            @include('admin.header')
        @show
    <!-- /header -->
    <!-- Header-->--}}

    @section('breadcrumbs')
        @include('admin.breadcrumbs')
    @show


    <div class="content mt-3">
        @if(Route::currentRouteName() == 'adminIndex')

        <div class="col-sm-12">
            <div class="text-center" role="alert">
                <img src="{{ asset(env('ADMIN_PUBLIC'))}}/welcome.webp" height="250">
            </div>
        </div>

            <div class="col-lg-12">
                <div class="text-center">
                    <h1 class="display-3">Добро пожаловать в Админ панель</h1>
                </div>
            </div>
        @endif
    @yield('content')
    </div> <!-- .content -->

</div><!-- /#right-panel -->

<!-- Right Panel -->

<script src="{{ asset(env('ADMIN_PUBLIC')) }}/admin/vendors/jquery/dist/jquery.min.js"></script>
<script src="{{ asset(env('ADMIN_PUBLIC')) }}/admin/vendors/popper.js/dist/umd/popper.min.js"></script>
<script src="{{ asset(env('ADMIN_PUBLIC')) }}/admin/vendors/bootstrap/dist/js/bootstrap.min.js"></script>

<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.js"></script>

<script src="{{ asset(env('ADMIN_PUBLIC')) }}/admin/assets/js/main.js?<?=time()?>"></script>

{{--<script src="{{ asset(env('ADMIN_PUBLIC')) }}/admin/assets/js/dashboard.js"></script>--}}
{{--<script src="{{ asset(env('ADMIN_PUBLIC')) }}/admin/vendors/jqvmap/dist/jquery.vmap.min.js"></script>--}}
{{--<script src="{{ asset(env('ADMIN_PUBLIC')) }}/admin/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>--}}
{{--<script src="{{ asset(env('ADMIN_PUBLIC')) }}/admin/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>--}}

{{--<script src="{{ asset(env('ADMIN_PUBLIC')) }}/admin/vendors/datatables.net/js/jquery.dataTables.min.js"></script>--}}
{{--<script src="{{ asset(env('ADMIN_PUBLIC')) }}/admin/vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>--}}
{{--<script src="{{ asset(env('ADMIN_PUBLIC')) }}/admin/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>--}}
{{--<script src="{{ asset(env('ADMIN_PUBLIC')) }}/admin/vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>--}}
{{--<script src="{{ asset(env('ADMIN_PUBLIC')) }}/admin/vendors/jszip/dist/jszip.min.js"></script>--}}
{{--<script src="{{ asset(env('ADMIN_PUBLIC')) }}/admin/vendors/pdfmake/build/pdfmake.min.js"></script>--}}
{{--<script src="{{ asset(env('ADMIN_PUBLIC')) }}/admin/vendors/pdfmake/build/vfs_fonts.js"></script>--}}
{{--<script src="{{ asset(env('ADMIN_PUBLIC')) }}/admin/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>--}}
{{--<script src="{{ asset(env('ADMIN_PUBLIC')) }}/admin/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>--}}
{{--<script src="{{ asset(env('ADMIN_PUBLIC')) }}/admin/vendors/datatables.net-buttons/js/buttons.colVis.min.js"></script>--}}
{{--<script src="{{ asset(env('ADMIN_PUBLIC')) }}/admin/assets/js/init-scripts/data-table/datatables-init.js"></script>--}}
{{--<script>--}}
{{--    (function($) {--}}
{{--        "use strict";--}}

{{--        jQuery('#vmap').vectorMap({--}}
{{--            map: 'world_en',--}}
{{--            backgroundColor: null,--}}
{{--            color: '#ffffff',--}}
{{--            hoverOpacity: 0.7,--}}
{{--            selectedColor: '#1de9b6',--}}
{{--            enableZoom: true,--}}
{{--            showTooltip: true,--}}
{{--            values: sample_data,--}}
{{--            scaleColors: ['#1de9b6', '#03a9f5'],--}}
{{--            normalizeFunction: 'polynomial'--}}
{{--        });--}}
{{--    })(jQuery);--}}
{{--</script>--}}

</body>

</html>
