@extends('Common::index')
@section('title', __('Edit Information'))

@section('page')
    <!-- end header  -->

    <main class="default_page__">
        <div class="container">
            <div class="default_form__ main_form__">
                <div class="form_title__ center__">
                    <h2 class="registeration_title site_head__ center__">
                        @lang('Edit Information')
                    </h2>
                    {{-- <p class="registeration_sub_title center__">
                        يمكنك تعديل بياناتك الشخصية
                    </p> --}}
                </div>
                <form method="POST">
                    @csrf
                    <div class="input_group__ custom_input_group__">
                        <label class="label__">@lang('Name')</label>
                        <div class="icon_input_group phone__">
                            <input class="input__" name="name" value="{{ $user->name }}" required type="text"
                                placeholder="@lang('Name')" />
                            @if ($errors->has('name'))
                                <span class="error">{{ $errors->get('name')[0] }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="input_group__ custom_input_group__">
                        <label class="label__">@lang('Mobile') </label>
                        <div class="icon_input_group phone__">
                            <input class="input__" name="mobile" required type="text" value="{{ $user->mobile }}"
                                placeholder="@lang('Mobile')" />
                            @if ($errors->has('mobile'))
                                <span class="error">{{ $errors->get('mobile')[0] }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="input_group__ custom_input_group__">
                        <label class="label__">@lang('Email')</label>
                        <div class="icon_input_group phone__">
                            <input class="input__" name="email" required type="email" value="{{ $user->email }}"
                                placeholder="@lang('Email') " />
                            @if ($errors->has('email'))
                                <span class="error">{{ $errors->get('email')[0] }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="final_buttons_wrapper__">
                        <button class="submit-button__ full_width__">
                            @lang('Save')
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

@stop
