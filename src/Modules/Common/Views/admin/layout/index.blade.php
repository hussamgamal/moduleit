<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>لوحة تحكم | {{ app_setting('title') }}</title>
    @stack('meta')
    <link rel="icon" href="{{ app_setting('favicon') }}" type="image/png">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ url('assets/admin') }}/plugins/fontawesome-free/css/all.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ url('assets/admin') }}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Custom style for RTL -->
    <link rel="stylesheet" href="{{ url('assets/admin') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ url('assets/admin') }}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet"
          href="{{ url('assets/admin') }}/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">

    <link href="//fonts.googleapis.com/css?family=Cairo&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('assets/admin') }}/css/adminlte.min.css">
    <link rel="stylesheet" href="{{ url('assets/admin') }}/css/custom.css?ver=1.203" media="all">
    @if (app()->getLocale() == 'ar')
        <link rel="stylesheet" href="{{ url('assets/admin') }}/css/bootstrap-rtl.min.css">
        <link rel="stylesheet" href="{{ url('assets/admin') }}/css/custom_ar.css?ver=1.2">
    @endif

    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/base/jquery-ui.min.css">
    @stack('styles')
    {{-- <script src="{{ url('assets/admin') }}/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script> --}}
    <script
        src="https://maps.googleapis.com/maps/api/js?key={{ app_setting('map_key') }}&sensor=false&libraries=places,geometry,drawing&lang=ar">
    </script>
    @vite('resources/js/app.js')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">


@include('Common::admin.layout.header')
@include('Common::admin.layout.side')


<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" id="mycontent">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">{{ $title }}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin') }}">@lang('Home page')</a></li>
                            <li class="breadcrumb-item active">{{ __($title) }}</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @yield('page')
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<!-- jQuery -->
<script src="{{ url('assets/admin') }}/js/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ url('assets/admin') }}/js/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 rtl -->
<script src="{{ url('assets/admin') }}/js/bootstrap.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{ url('assets/admin') }}/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="{{ url('assets/admin') }}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->

<script src="{{ url('assets/admin') }}/js/adminlte.min.js"></script>

<script src="{{ url('assets/admin') }}/js/demo.js?ver=01"></script>
<script src="{{ url('assets/admin') }}/js/dashboard/navigator.js?ver=01"></script>
<script src="{{ url('assets/admin') }}/js/dashboard/images.js?ver=01"></script>
<script src="{{ url('assets/admin') }}/js/dashboard/form.js?ver=01"></script>

<script src="{{ url('assets/admin') }}/plugins/datatables/jquery.dataTables.js"></script>
<script src="//cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="//cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<link rel="stylesheet" href="{{ url('assets/admin') }}/plugins/summernote/summernote-bs4.css">
<script src="{{ url('assets/admin') }}/plugins/select2/js/select2.full.min.js"></script>
<script src="{{ url('assets/admin') }}/plugins/summernote/summernote-bs4.min.js"></script>
<!-- InputMask -->
<script src="{{ url('assets/admin') }}/plugins/inputmask/jquery.inputmask.bundle.js"></script>
<script src="{{ url('assets/admin') }}/plugins/sweetalert2/sweetalert2.all.min.js"></script>


<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ url('assets/admin') }}/plugins/jquery-knob/jquery.knob.min.js"></script>
<script src="{{ url('assets/admin') }}/plugins/moment/moment.min.js"></script>
<script src="{{ url('assets/admin') }}/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.6.0/jQuery.print.min.js"></script>
@include('Common::admin.layout._firebase')
@stack('js')
<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('body').on('change', '.change_status', function () {
        $.get($(this).data('route'), {
            id: $(this).val()
        });
    });
    $('#mycontent').click(function () {
        $('.dropdown-menu').slideUp(0);
    });
    $('.dropdowntoggle').click(function () {
        $('.dropdown-menu').slideUp(0);
        $(this).closest('.dropdown').find('.dropdown-menu').slideToggle();
    });

    $(function () {
        'use strict'
        $('body').on('click', '.notifications', function () {
            $.ajax({
                type: 'post',
                postType: 'json',
                url: `{{route('admin.notifications.read')}}`,
            })
        })
    })


    $('body').on('click', '.print_bill', function () {
        $('.order_bill').print();
    });
</script>

</body>

</html>
