@extends('Common::index')
@section('title', __('Pay fees'))

@section('page')
    <form method="POST" enctype="multipart/form-data">
        @foreach ($errors->all() ?? [] as $error)
            <li>{{ $error }}</li>
        @endforeach
        @csrf
        <main class="booking_page default_page__ top_small_padding">
            <div class="container">
                <div class="page_head_wrapper flex_display with_icon__">
                    <figure class="icon__ loading-omd">
                        <img class="lazy-omd img-om" data-src="{{ url('assets/web') }}/images/shapes/calendar.png"
                            alt="..." />
                    </figure>
                    <div>
                        <h1 class="page_main_title__">@lang('Pay fees')</h1>
                        <h5 class="page_sub_title__">@lang('Please enter transfer date and transfer bill')</h5>
                    </div>
                </div>
            </div>
            <h2 class="section_main_title__">
                <div class="container">@lang('Transfer Details')</div>
            </h2>
            <div class="container">
                <div class="inputs_wrapper">

                    <div class="input_group__ date_input__ none_margin__">
                        <input name="date" class="input__ datepicker__" id="datepicker" type="text"
                            placeholder="@lang('Transfer date')" />
                    </div>

                    <div class="input_group__ flex_group__ group_gap__">
                        <label class="upload_profile_photo_label" for="upload_profile_photo_input">
                            <div class="provider_img_block none_before_shape">
                                <figure class="figure__ asp-om provider_profile_figure__">
                                    <img class="img-om provider_profile_img_uploaded"
                                        src="{{ url('assets/web') }}/images/shapes/backgroundEmpty.svg" alt="" />
                                </figure>
                            </div>
                            <div class="upload_profile_photo_label_overlay__"></div>
                        </label>
                        <input type="file" required name="image" class="upload_profile_photo_input"
                            id="upload_profile_photo_input" accept=".png, .jpg, .jpeg" />
                        <h5 class="uploadProfile_title__">
                            @lang('Attach transfer bill')
                        </h5>
                    </div>
                </div>
            </div>
            <h2 class="section_main_title__">
                <div class="container">@lang('Bank account')</div>
            </h2>

            <div class="container">

                <div class="row row_modify with_row_gap">
                    <div class="col-md-6">
                        <div class="bank_account_wrapper">
                            <div class="bank_name_wrapper">
                                <h4 class="title__">@lang('Bank Name')</h4>
                                <h6 class="info__">{{ app_setting('bank_name') }}</h6>
                                <figure class="icon__ loading-omd">
                                    <img class="lazy-omd img-om" style="width: 50px"
                                        data-src="{{ url(app_setting('bank_logo')) }}" alt="..." />
                                </figure>
                            </div>
                            <div class="account_info_wrapper">
                                <h3 class="title__">
                                    @lang('Bank Account Number') :
                                    <span class="info__">{{ app_setting('bank_account_number') }}</span>
                                </h3>
                                <h3 class="title__">
                                    (IBAN) :
                                    <span class="info__">{{ app_setting('bank_account_ipan') }}</span>
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <button class="submit-button__ full_width_small_screen_only submit_booking" type="submit">
                            @lang('Confirm Request')
                        </button>
                    </div>
                </div>
            </div>
        </main>
    </form>

@stop
