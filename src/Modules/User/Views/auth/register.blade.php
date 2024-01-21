@extends('Common::index')
@section('title', __('Register'))

@section('page')
    <main class="registeration_page__ sign_up_page__">
        <div class="container">
            <div class="main_form__ default_form__">
                <h2 class="registeration_title site_head__ center__">
                    @lang('Create new account for owner or renter')
                </h2>
                <p class="registeration_sub_title center__">
                    @lang('Register your data to create a new account')
                </p>
                
                <form method="POST">
                    @csrf
                    <div class="input_group__">
                        <input class="input__" type="text" required name="name" value="{{ old('name') }}"
                            placeholder="@lang('Username')" />
                        @if ($errors->has('name'))
                            <span class="error">{{ $errors->get('name')[0] }}</span>
                        @endif
                    </div>
                    <div class="input_group__">
                        <input class="input__" type="text" required name="mobile" value="{{ old('mobile') }}"
                            placeholder="@lang('Mobile')" />
                        @if ($errors->has('mobile'))
                            <span class="error">{{ $errors->get('mobile')[0] }}</span>
                        @endif
                    </div>
                    <div class="input_group__">
                        <input class="input__" type="email" required name="email" value="{{ old('email') }}"
                            placeholder="@lang('Email')" />
                        @if ($errors->has('email'))
                            <span class="error">{{ $errors->get('email')[0] }}</span>
                        @endif
                    </div>

                    <div class="input_group__">
                        <input class="submit-button__ full_width__ input__" type="submit" value="@lang('Register')" />
                    </div>

                    <a class="link__ submit-button__ sign_up_link__" href="{{ route('login') }}">@lang('Login')</a>
                </form>
            </div>
        </div>
    </main>
@stop
