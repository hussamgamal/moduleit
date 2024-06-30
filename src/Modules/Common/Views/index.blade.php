<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>{{ app_setting('title') }}</title>

    <link rel="Site Icon" href="{{ app_setting('favicon') }}" />
    @if (app()->getLocale() == 'ar')
        <!-- ############################################################# -->
        <!-- ################ Include Bootstrap Css Files ################ -->
        <!-- #########################  Ar Pages ######################### -->
        <link rel="stylesheet" href="{{ url('assets/web') }}/css/bootstrap-rtl.min.css" />
    @else
        <!-- #########################  En Pages ######################### -->
        <link rel="stylesheet" href="{{ url('assets/web') }}/css/bootstrap.min.css">
        <!-- ############################################################ -->
    @endif
    <link rel="stylesheet" href="{{ url('assets/web') }}/css/bootstrap-select.min.css" />
    <link rel="stylesheet" href="{{ url('assets/web') }}/css/all.min.css" />
    <link rel="stylesheet" href="{{ url('assets/web') }}/css/swiper.min.css" />
    <link rel="stylesheet" href="{{ url('assets/web') }}/css/style.css?ver=1.02" />
    <link rel="stylesheet" href="{{ url('assets/web') }}/css/custom.css?ver=1.01" />
    <script src="{{ url('assets/web') }}/js/jquery-3.3.1.min.js"></script>

    @yield('metatags')

</head>

<body class="body-grey">
    @include('Common::site.layout.header')

    @yield('page')

    @include('Common::site.layout.footer')


    <!-- start js include  -->
    @include('Common::site.layout.modals')

    @include('Common::site.layout.scripts')

    @include('Common::popups')
    <script>
        $("[name='brand_id']").change(function() {
            $.get("{{ route('brand.marks') }}", {
                id: $(this).val()
            }, function(res) {
                $("[name='mark_id']").html(res).selectpicker('refresh');
            });
        });
        $(document).ready(function() {
            var current_link = "{{ url()->full() }}";
            if ($(".header-nav a[href='" + current_link + "']").length) {
                $(".header-nav a").removeClass('active');
                $(".header-nav a[href='" + current_link + "']").addClass('active');
            }

            $('.like_this').click(function() {
                var btn = $(this);
                $.get("{{ route('items.like') }}", {
                    id: $(this).data('id')
                }, function(res) {
                    if (res.liked) {
                        btn.addClass('favorite-product-active-om');
                        btn.find('span').html("{{ __('Remove from favourites') }}");
                    } else {
                        btn.removeClass('favorite-product-active-om');
                        btn.find('span').html("{{ __('Add to favourites') }}");
                    }
                });
            });


            $('.add_to_cart').click(function() {
                var btn = $(this);
                $.get("{{ route('add_to_cart') }}", {
                    item_id: btn.data('id'),
                    count: btn.closest('div').find("[name='amount']").val() ?? 1
                }, function(res) {
                    $(".cart-cout-total").html(res.count);
                    console.log(res.item_count);
                    btn.find('.cart-cout').html(res.item_count);
                    btn.addClass('active');
                });
            });

            $(".action_form").submit(function() {
                if (!check_required($(this))) {
                    return false;
                }
            });

            $('.login-om').click(function() {
                $('#signinmodal .active-om').removeAttr('style').removeClass('active-om');
                $("#signinmodal #signin-tab-id-om").removeAttr('style').addClass('active-om');
                $("#signinmodal #signin_tab_mobile_option_ .login_form").show();
                $("#signinmodal #signin_tab_mobile_option_ .verify_form").hide();
            });
        });


        function check_required(form) {
            $('.requiredInp').removeClass('requiredInp');
            var inputs = form.find("[required]");
            var val = 0;
            inputs.each(function(key) {
                var tab = 0;
                if ($(this).val() == '') {
                    val = tab = 1;
                    $(this).addClass('requiredInp');
                } else if ($(this).attr('type') == 'checkbox' && inputs[key].checked == false) {
                    val = tab = 1;
                    // $(this).parent().find('.checkmark').addClass('requiredInp');
                    $(this).addClass('requiredInp');
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
                    window.scrollTo({
                        top: $('.requiredInp:visible:first').offset().top - 10,
                        behavior: 'smooth',
                    });
                    return false;
                }
            }
            return true;
        }
        $("[type='number']").keypress(function(evt) {
            evt.preventDefault();
        });

        $(".change_quantity_").click(function() {
            var btn = $(this);
            var count = btn.closest('div').find(".input-om").val();
            btn.hasClass('plus__') ? count++ : count--;
            console.log(btn.hasClass('plus__'), count);
            $.get("{{ route('add_to_cart') }}", {
                count: count,
                item_id: btn.closest('.cart-product-block-om').find("[name='item_id']").val()
            }, function(res) {
                $(".cart-cout-total").html(res.count);
                btn.find('.cart-cout').html(res.item_count);
                btn.closest('.cart-product-block-om').find('.price-number-om').html(res.price);
            });
        });
    </script>

    @if (request('login') && !auth()->check())
        <script>
            $("#signinmodal").modal('show');
        </script>
    @endif

    <script>
        $(document).ready(function() {
            $(".header_list_item__").removeClass('active');
            $(".header_list_item__  a[href='{{ url()->full() }}']").closest('li').addClass('active');
        });
        $("[name='brand_id']").change(function() {
            $.get("{{ route('brand.marks') }}", {
                id: $(this).val()
            }, function(res) {
                $("[name='mark_id']").html(res).selectpicker('refresh');
            });
        });
    </script>

    @yield('scripts')
</body>

</html>
