<!-- Start Add To Cart Modal -->

<div class="modal fade deal_modal_report" id="add_to_cart-modal" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content second_padding__">
            <div class="modal_block__">
                <div class="icon_title_wrapper__">
                    <img class="icon__" src="{{ url('assets/web') }}/images/shapes/shopping_cart.svg" alt="..." />
                    <h2 class="title">تم إضافة المنتجات إلى السلة</h2>

                    <button type="button" class="close_modal_button button__" data-dismiss="modal" aria-label="Close">
                        <img class="close_modal_img" src="{{ url('assets/web') }}/images/modal/close_modal_icon.svg"
                            alt="" />
                        <img class="icon__" src="{{ url('assets/web') }}/images/shapes/modal_close_icon.svg"
                            alt="..." />
                    </button>
                </div>

                {{-- <p class="parag__">
                    تم إضافة عدد 3 من المنتجات إلى سلتك يمكنك الذهاب إلى السلة وإنهاء طلبك
                </p> --}}

                <a href="{{ route('cart.index') }}" class="button__ submit-button__ full_width__">
                    الذهاب إلى السلة
                </a>
                <a href="{{ route('items.index') }}" class="button__ submit-button__ full_width__">
                    إكمال التسوق
                </a>
            </div>
        </div>
    </div>
</div>

<!-- End Add To Cart Modal -->

<!-- Start Delete Address Modal -->

<div class="modal fade deal_modal_report" id="delete_address-modal" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content second_padding__">
            <div class="modal_block__">
                <div class="icon_title_wrapper__">
                    <img class="icon__" src="{{ url('assets/web') }}/images/shapes/delete_icon.svg" alt="..." />
                    <h2 class="title">@lang('Delete Address')</h2>

                    <button type="button" class="close_modal_button button__" data-dismiss="modal" aria-label="Close">
                        <img class="close_modal_img" src="{{ url('assets/web') }}/images/modal/close_modal_icon.svg"
                            alt="" />
                        <img class="icon__" src="{{ url('assets/web') }}/images/shapes/modal_close_icon.svg"
                            alt="..." />
                    </button>
                </div>

                <p class="parag__">@lang('Are you sure you want to delete this address ?')</p>

                <form action="{{ route('address_delete') }}" method="POST">
                    @csrf
                    {{ method_field('DELETE') }}
                    <input type="hidden" name="id">
                    <button class="button__ submit-button__ full_width__ red_background">
                        @lang('Yes')
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- End Delete Address Modal -->

<!-- Start Sign Out Modal -->

<div class="modal fade deal_modal_report" id="sign_out_modal" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content second_padding__">
            <div class="modal_block__">
                <div class="icon_title_wrapper__">
                    <img class="icon__" src="{{ url('assets/web') }}/images/shapes/header_shapes/log_out.svg"
                        alt="..." />
                    <h2 class="title">تسجيل الخروج</h2>

                    <button type="button" class="close_modal_button button__" data-dismiss="modal" aria-label="Close">
                        <img class="close_modal_img" src="{{ url('assets/web') }}/images/modal/close_modal_icon.svg"
                            alt="" />
                        <img class="icon__" src="{{ url('assets/web') }}/images/shapes/modal_close_icon.svg"
                            alt="..." />
                    </button>
                </div>

                <p class="parag__">هل أنت متأكد من تسجيل الخروج من حسابك ؟</p>

                <a href="{{ route('logout') }}" class="button__ submit-button__ full_width__ red_background">
                    تسجيل الخروج
                </a>
            </div>
        </div>
    </div>
</div>

<!-- End Sign Out Modal -->
