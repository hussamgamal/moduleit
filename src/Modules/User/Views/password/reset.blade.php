@extends('Common::index')
@section('title', __('Change Password'))

@section('page')
    <main class="registeration_page__">
        <div class="container">
            <div class="main_form__ default_form__">
                <form action="">
                    <figure class="figure__ register_figure__ loading-omd center">
                        <img class="lazy-omd img-om" data-src="assets/images/register/new_password.png" alt="...">
                    </figure>
                    <div class="registeration_head_wrapper__">
                        <h2 class="registeration_title center__">@lang('New Password')</h2>
                        <p class="registeration_sub_title center__">
                            @lang('Set your new password')
                        </p>
                    </div>

                    <div class="input_group__ input_group_with_icon__ password_input_group__">
                        <div class="password-group-om icon_input_group password__">
                            <input class="input__" type="password" name="password" required placeholder="@lang('Password')" />

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

                    <div class="input_group__ input_group_with_icon__ password_input_group__">
                        <div class="password-group-om icon_input_group password__">
                            <input class="input__" type="password" name="password_confirmation" required placeholder="@lang('Password Confirmation')" />

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

                    <div class="input_group__">
                        <input class="submit-button__ full_width__ input__" type="submit" value="@lang('Change Password')" />
                    </div>
                </form>
            </div>
        </div>
    </main>
@stop
