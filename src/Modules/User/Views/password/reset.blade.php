@extends('Common::index')
@section('title', __('Change Password'))

@section('page')
    <main class="registeration_page__">

        <div class="container">

            <div class="main_form__ default_form__">
                <figure class="form_image__ small_size_image__  figure__ asp-om">
                    <img class="img-om"src="{{ url('assets/web') }}/images/shapes/new_password_page_icon.svg" alt=".." height="" />
                </figure>
                <div class="form_title__ centered ">
                    <h1 class="title__ title_first__">@lang('Change Password')</h1>
                    <p class="parg__ not_full_width__">
                        @lang('Set a new password for your account')
                    </p>
                </div>
                <form method="POST" action="{{ route('password.new' , $mobile) }}">
                    @csrf
                    <div class="input_group__">
                        <div class="password-group-om icon_input_group password__">
                            <input class="input__" type="password" name="password" required
                                placeholder="@lang('New Password')" />

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
                        <div class="password-group-om icon_input_group password__">
                            <input class="input__" type="password" required name="password_confirmation"
                                placeholder="@lang('Password Confirmation')" />

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


                    <button class="submit-button__  full_width__">
                        @lang('Change Password')
                    </button>
                </form>
            </div>
        </div>
    </main>
@stop
