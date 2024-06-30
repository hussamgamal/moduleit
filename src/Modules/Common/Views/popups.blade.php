@if (session()->has('error'))
    <div class="modal fade deal_modal_report" id="popup-error" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content second_padding__">
                <div class="modal_block__">
                    <div class="icon_title_wrapper__">
                        <div data-dismiss="modal" class="close"><img src="{{ url('assets/web') }}/images/close.svg"
                                alt=""></div>
                    </div>

                    <div class="cont-modal">
                        <svg class="modal_icon"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                            <path
                                d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zm0-384c13.3 0 24 10.7 24 24V264c0 13.3-10.7 24-24 24s-24-10.7-24-24V152c0-13.3 10.7-24 24-24zM224 352a32 32 0 1 1 64 0 32 32 0 1 1 -64 0z" />
                        </svg>

                        <h2 class="title">{{ session('error') }}</h2>
                        <br>
                    </div>


                </div>

            </div>
        </div>
    </div>

    <script>
        $('#popup-error').modal('show');
    </script>
@elseif(session()->has('success'))
    <div class="modal fade deal_modal_report" id="popup-done" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content second_padding__">
                <div class="modal_block__">
                    <div class="icon_title_wrapper__">
                        <div data-dismiss="modal" class="close"><img src="{{ url('assets/web') }}/images/close.svg"
                                alt=""></div>
                    </div>

                    <div class="cont-modal">
                        <svg class="modal_icon"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                            <path
                                d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z" />
                        </svg>

                        <h2 class="title">{{ session('success_title') }}</h2>

                        <p class="style">{{ session('success') }}</p>

                        {{-- <a href="{{ url('/') }}" class="butt-om"> @lang('Home')</a> --}}

                    </div>


                </div>

            </div>
        </div>
    </div>
    <script>
        $('#popup-done').modal('show');
    </script>
@elseif(session()->has('warning'))
    <div class="modal fade deal_modal_report" id="popup-warning" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content second_padding__">
                <div class="modal_block__">
                    <div class="icon_title_wrapper__">
                        <div data-dismiss="modal" class="close"><img src="{{ url('assets/web') }}/images/close.svg"
                                alt=""></div>
                    </div>

                    <div class="cont-modal">
                        <img src="{{ url('assets/web') }}/images/warning.svg" alt="">

                        <h2 class="title">{{ session('warning') }}</h2>
                        @if (Route::currentRouteName() != 'user.active')
                            <a href="{{ route('login') }}" class="butt-om">@lang('Login')</a>
                        @endif

                    </div>


                </div>

            </div>
        </div>
    </div>
    <script>
        $('#popup-warning').modal('show');
    </script>
@endif
