@extends('Common::index')
@section('title', $title)
@section('page')
    <!-- Start Contact Us Section -->
    <section class="contact_us_section default_section__" id="home_page_contact_us_section">
        <div class="container">
            <div class="contact_us_content default_form__">
                <div class="page_head_wrapper center__">
                    <h2 class="page_main_title__">@lang('Contact us')</h2>
                    <h4 class="page_sub_title__">
                        @lang('Contact us and send your claim or message')
                    </h4>
                </div>

                <form action="{{ route('contactus') }}" method="POST">
                    @csrf
                    <div class="input_group__">
                        <div class="icon_input_group phone__">
                            <input class="input__" type="text" name="name" required placeholder="@lang('Fullname')" />
                        </div>
                    </div>
                    <div class="input_group__">
                        <input class="input__" type="text" placeholder="@lang('Email')" required name="email" />
                    </div>
                    <div class="input_group__">
                        <input class="input__" type="email" placeholder="@lang('Email')" required name="email" />
                    </div>
                    <div class="input_group__">
                        <textarea class="input__ textarea-om" placeholder="@lang('Message')" required name="message" cols="30"
                            rows="10"></textarea>
                    </div>

                    <div class="input_group__">
                        <input class="submit-button__ full_width__ input__" type="submit" value="@lang('Send')" />
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- End Contact Us Section -->
@stop
