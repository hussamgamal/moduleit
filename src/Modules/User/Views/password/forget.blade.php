@extends('Common::index')
@section('title', __('Forget Password'))

@section('page')
    <main class="registeration_page__">

        <div class="container">

            <div class="main_form__ default_form__">
                <figure class="form_image__ small_size_image__  figure__ asp-om">
                    <img class="img-om" src="{{ url('assets/web') }}/images/shapes/forget_password.svg" alt=".."
                        height="" />
                </figure>
                <div class="form_title__ centered ">
                    <h1 class="title__ title_first__">@lang('Forget password?')</h1>
                    <p class="parg__ not_full_width__">
                        @lang('Enter your mobile to send reset code')
                    </p>
                </div>
                <form action="" method="POST">
                    @csrf
                    <div class="input_group__">
                        <div class="icon_input_group phone__">
                            <input class="input__" type="text" required name="mobile" placeholder="@lang('Mobile')" />
                        </div>
                    </div>
                    <button class="submit-button__  full_width__">
                        @lang('Send Reset Code')
                    </button>
                </form>
            </div>
        </div>
    </main>

@stop
