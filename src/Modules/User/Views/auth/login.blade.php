@extends('Common::index')
@section('title', __('Login'))

@section('page')
    <main class="registeration_page__">
        <div class="container">
            <div class="main_form__ default_form__">
                <h2 class="registeration_title site_head__ center__">@lang('Login') </h2>
                <p class="registeration_sub_title center__">
                    @lang('Select the account type and log in')
                </p>

                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="input_group__">
                        <select name="type" class="select__ selectpicker with_icon__" id="sign_in_select__">
                            <option inputs_element_class="gest_wrapper" value="visitor" selected>@lang('Visitor Account') </option>
                            <option inputs_element_class="owner_wrapper" value="renter_owner">@lang('Renter - Owner Account')</option>
                        </select>
                    </div>

                    <div class="gest_wrapper">
                        <div class="input_group__">
                            <input class="input__" value="{{ old('mobile') }}" type="text" name="mobile"
                                placeholder="@lang('Mobile')" />
                            @if ($errors->has('mobile'))
                                <span class="error">{{ $errors->get('mobile')[0] }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="owner_wrapper">
                        <div class="input_group__">
                            <input class="input__" type="text" name="name" placeholder="@lang('Username')" />
                        </div>
                        <div class="input_group__">
                            <div class="password-group-om icon_input_group password__">
                                <input class="input__" type="password" name="password" placeholder="@lang('Password')" />

                                <button class="show-password-button-om">
                                    <figure class="figure__">
                                        <svg class="icon__" id="noun-eye-1219080" xmlns="http://www.w3.org/2000/svg"
                                            width="20.139" height="13.264" viewBox="0 0 20.139 13.264">
                                            <path id="Path_59344" data-name="Path 59344"
                                                d="M118.658,120.03c-4.082-4.646-7.758-5.34-9.584-5.34s-5.5.694-9.584,5.34a1.961,1.961,0,0,0,0,2.584c4.082,4.646,7.758,5.34,9.584,5.34s5.5-.694,9.584-5.34a1.961,1.961,0,0,0,0-2.584Zm-.845,1.842c-1.31,1.489-4.783,4.958-8.739,4.958s-7.43-3.469-8.739-4.958a.836.836,0,0,1,0-1.1c1.31-1.49,4.783-4.958,8.739-4.958s7.429,3.469,8.739,4.958a.836.836,0,0,1,0,1.1Z"
                                                transform="translate(-99.005 -114.69)" fill="#818181" />
                                            <path id="Path_59345" data-name="Path 59345"
                                                d="M248.942,174.16a4.257,4.257,0,1,0,3.014,1.239,4.246,4.246,0,0,0-3.014-1.239Zm0,7.369a3.132,3.132,0,1,1,2.22-.909,3.122,3.122,0,0,1-2.22.909Z"
                                                transform="translate(-238.873 -171.774)" fill="#818181" />
                                        </svg>
                                    </figure>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="input_group__">
                        <input class="submit-button__ full_width__ input__" type="submit" value="@lang('Login')" />
                    </div>

                    <a class="link__ submit-button__ sign_up_link__" href="{{ route('register') }}"
                        id="sign_in_page_new_account_link__">@lang('Create new account') </a>
                </form>
            </div>
        </div>
    </main>
@stop
