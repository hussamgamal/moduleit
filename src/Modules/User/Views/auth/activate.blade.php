@extends('Common::index')
@section('title', __('Confirmation Code'))

@section('page')
    <main class="registeration_page__">
        <div class="container">
            <div class="main_form__ default_form__">
                <form class="default_form__">
                    <figure class="figure__ register_figure__ loading-omd center">
                        <img class="lazy-omd img-om" data-src="assets/images//register/register_verification.png"
                            alt="..." />
                    </figure>
                    <div class="registeration_head_wrapper__">
                        <h2 class="registeration_title center__">@lang('Confirm Mobile')</h2>
                        <p class="registeration_sub_title center__">
                            @lang('Your verification code has been sent, please check your phone and re-type the code to retrieve')
                        </p>
                    </div>

                    <div class="input_group__">
                        <div class="input-group-om code_shapes__">
                            <input name="code[]" class="code-input" placeholder="__" required />
                            <input name="code[]" class="code-input" placeholder="__" required />
                            <input name="code[]" class="code-input" placeholder="__" required />
                            <input name="code[]" class="code-input" placeholder="__" required />
                            <input name="code[]" class="code-input" placeholder="__" required />
                        </div>
                    </div>
                    <div class="input_group__">
                        <input class="submit-button__ full_width__ input__" type="submit" value="@lang('Confirm')" />
                    </div>

                    {{-- <div class="input_group__">
                        <button id="send_code_again_button__"
                            class="link__ submit-button__ sign_up_link__ send_code_again_button__">
                            <img class="icon__" src="{{ url('assets/web') }}/images/shapes/send_code_again_btn_icon.svg" alt="..." />
                            @lang('Resend code')
                        </button>
                    </div> --}}
                </form>
            </div>
        </div>
    </main>
@stop
