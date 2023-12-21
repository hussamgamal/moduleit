<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
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
    <link rel="stylesheet" href="{{ url('assets/admin') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="{{ url('assets/admin') }}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet"
        href="{{ url('assets/admin') }}/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">

    <link href="//fonts.googleapis.com/css?family=Cairo&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('assets/admin') }}/css/adminlte.min.css">
    <link rel="stylesheet" href="{{ url('assets/admin') }}/css/custom.css?ver=1.2213" media="all">
    @if (app()->getLocale() == 'ar')
        <link rel="stylesheet" href="{{ url('assets/admin') }}/css/bootstrap-rtl.min.css">
        <link rel="stylesheet" href="{{ url('assets/admin') }}/css/custom_ar.css?ver=1.2">
    @endif
    @stack('styles')
    {{-- <script src="{{ url('assets/admin') }}/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script> --}}
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">


        @include('Common::admin.layout.header')
        @if (!auth('stores')->check())
            @include('Common::admin.layout.side')
        @endif

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" id="mycontent" @if (auth('stores')->check()) style="margin:0px" @endif>
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
    <script src="{{ url('assets/admin') }}/js/demo.js?ver={{ time() }}"></script>
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
    <script src="{{ url('assets/admin') }}/plugins/chart.js/Chart.min.js"></script>
    <script src="{{ url('assets/admin') }}/plugins/moment/moment.min.js"></script>
    <script src="{{ url('assets/admin') }}/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.6.0/jQuery.print.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhrb6fzdSQde8YvPysj152NMMtRfBmAiE&sensor=false&libraries=places&lang=ar">
    </script>
    <script>
        $('body').on('change', '.change_status', function() {
            $.get($(this).data('route'), {
                id: $(this).val()
            });
        });
        $('#mycontent').click(function() {
            $('.dropdown-menu').slideUp(0);
        });
        $('.dropdowntoggle').click(function() {
            $('.dropdown-menu').slideUp(0);
            $(this).closest('.dropdown').find('.dropdown-menu').slideToggle();
        });
        var fromajax = 0;
        $('body').on('click', '.mlink,.page-link', function() {
            $('.dropdown-menu').slideUp(0);
            fromajax = 1;
            localStorage.setItem('from_route', 1);
            var url = $(this).attr('href');
            $('#mycontent').html(
                "<div class='pgloader'><i class='fa fa-spinner fa-spin fa-3x fa-fw'></i></div>");
            $('#mycontent').load(url);
            window.history.pushState("", "", url);
            return false;
        });
        $('body').on('submit', '.action_form', function() {
            var form = $(this);

            if (form.hasClass('remove')) {
                Swal.fire({
                    text: "{{ __('Do you want to delete ?') }}",
                    icon: "warning",
                    showConfirmButton: true,
                    confirmButtonText: "{{ __('Yes') }}",
                    showCancelButton: true,
                    cancelButtonText: "{{ __('No') }}"
                }).then(function(ok) {
                    if (!ok.value) {
                        return false;
                    } else {
                        form_action(form);
                    }
                });
            } else {
                if (check_required(form)) {
                    form_action(form);
                }
            }
            return false;
        });
        $('body').on('submit', '#search_form , .search_form', function() {
            $('#mycontent').html(
                "<div class='pgloader'><i class='fa fa-spinner fa-spin fa-3x fa-fw'></i></div>");
            var url = window.location.href.split('?')[0];
            if (url.indexOf('?') >= 0) {
                url += "&keyword=" + encodeURIComponent($("[name='keyword']").val()) + '&' + $(this).serialize();
            } else {
                url += "?keyword=" + encodeURIComponent($("[name='keyword']").val()) + '&' + $(this).serialize();
            }
            if ($(this).hasClass('inline_search')) {
                url += '&' + $(this).serialize();
            }
            $('#mycontent').load(url);
            window.history.pushState("", "", url);
            return false;
        });

        function form_action(form) {
            $('.card-footer button').prop('disabled', true);
            $('.sperror').remove();
            $('.fa-save').addClass('fa-spinner').addClass('fa-spin');
            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                data: new FormData(form[0]),
                contentType: false,
                processData: false,
                success: function(result) {
                    $('.fa-save').remove();
                    if (form.hasClass('not_swal_fire')) {
                        $('#mycontent').html(
                            "<div class='pgloader'><i class='fa fa-spinner fa-spin fa-3x fa-fw'></i></div>"
                        );
                        localStorage.setItem('from_route', 1);
                        $('#mycontent').load(result.url);
                        window.history.pushState("", "", result.url);
                    } else {
                        Swal.fire({
                            position: 'top',
                            // icon: "success",
                            text: result.message,
                            showConfirmButton: false,
                        }).then(function() {
                            // if (form.hasClass('choose_meals')) {
                            //     window.location = window.location;
                            //     return true;
                            // }
                            $('#mycontent').html(
                                "<div class='pgloader'><i class='fa fa-spinner fa-spin fa-3x fa-fw'></i></div>"
                            );
                            localStorage.setItem('from_route', 1);
                            $('#mycontent').load(result.url);
                            window.history.pushState("", "", result.url);
                        });
                    }
                },
                error: function(errors) {
                    if (errors && errors.responseJSON.errors) {
                        var errors = errors.responseJSON.errors;
                        var keys = Object.keys(errors);
                        $.each(keys, function(i, el) {
                            form.find("[name='" + el + "']").closest('.form-group').find('label')
                                .append("<span class='sperror'>( " + errors[el][0] + " )</span>");
                        });
                        $('.fa-save').removeClass('fa-spin').removeClass('fa-spinner').closest('button')
                            .prop('disabled', false);
                        if ($('.sperror:visible').length) {
                            $('html, body').animate({
                                scrollTop: $('.sperror:visible:first').offset().top
                            }, 500);
                        }
                    }
                }
            });
        }

        function check_required(form) {
            $('.requiredInp').removeClass('requiredInp');
            var inputs = form.find("[required]");
            var val = 0;

            inputs.each(function(key) {
                var tab = 0;
                if ($(this).val() == '' || !$(this).val()) {
                    val = tab = 1;
                    $(this).addClass('requiredInp');
                    $(this).closest('.form-group').find('.mycustom-file').addClass('requiredInp');
                    $(this).closest('.form-group').find('.select2').addClass('requiredInp');
                } else if ($(this).attr('type') == 'checkbox' && inputs[key].checked == false) {
                    val = tab = 1;
                    $(this).parent().find('.checkmark').addClass('requiredInp');
                }
                if (tab == 1) {
                    var tab = $(this).closest('.tab-pane').attr('id');
                    if (tab) {
                        $("a[href='#" + tab + "']").addClass('requiredInp');
                    }
                }
            });
            if (val == 1) {
                if (!$('.contactsDiv').length) {
                    if ($('.requiredInp:visible').length) {
                        window.scrollTo({
                            top: $('.requiredInp:visible:first').offset().top - 10,
                            behavior: 'smooth',
                        });
                        return false;
                    }
                }
            }
            return true;
        }

        var url = localStorage.getItem('route');
        if (url && url != 0 && fromajax != 1) {
            fromajax = 1;
            $('#mycontent').load(url);
            window.history.pushState("", "", url);
        }
        $('body').on('change', '.mycustom-file-input', function() {
            var image = $(this).parent().find('.image');
            var multiple = $(this).attr('multiple');
            readFile(this, image, multiple);
        });

        function readFile(input, image, multiple) {
            if (multiple) {
                $('.imgTag').remove();
                if (files = input.files) {
                    for (var i = files.length - 1; i >= 0; i--) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $('.multi_images').prepend("<div class='imgTag'><img src='" + e.target.result +
                                "' /></div>");
                        }
                        reader.readAsDataURL(files[i]); // convert to base64 string
                    }
                }
            } else {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        image.find('img').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]); // convert to base64 string
                    image.find('img').show();
                    image.find('i,span').hide();
                } else {
                    image.find('img').hide();
                    image.find('i,span').show();
                }
            }
        }


        $('body').on('click', '.print_bill', function() {
            $('.order_bill').print();
        });

        window.addEventListener('popstate', function(e) {
            var url = window.location.href;
            fromajax = 1;
            localStorage.setItem('from_route', 1);
            $('#mycontent').html(
                "<div class='pgloader'><i class='fa fa-spinner fa-spin fa-3x fa-fw'></i></div>");
            $('#mycontent').load(url);
        });
    </script>

</body>

</html>
