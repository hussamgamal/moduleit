@extends('Common::index')
@section('title', __('Forget Password'))

@section('page')
    <main class="registeration_page__">
        <div class="container">
            <div class="main_form__ default_form__">
                <form action="">
                    <figure class="figure__ register_figure__ loading-omd center">
                        <img class="lazy-omd img-om" data-src="assets/images/register/forget_password.png" alt="...">
                    </figure>
                    <div class="registeration_head_wrapper__">
                        <h2 class="registeration_title center__">@lang('Do you forget your password?')</h2>
                        <p class="registeration_sub_title center__">
                            @lang('Enter your mobile number to send the verification code')
                        </p>
                    </div>

                    <div class="input_group__ input_group_with_icon__ phone_input_group__">
                        <input class="input__" type="text" placeholder="@lang('Mobile')" name="mobile" required />
                    </div>


                    <div class="input_group__">
                        <input class="submit-button__ full_width__ input__" type="submit" value="@lang('Send Reset Code')" />
                    </div>

                </form>
            </div>
        </div>
    </main>

@stop
