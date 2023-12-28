@extends('Common::index')
@section('title', $title)
@section('page')
<!-- start main-presonal-page-om -->
<main class="main-inquires-traders-page-om">
    <div class="container">

        <section class="inquires-traders-om personal-card-om">

            <h3 class="sub-data-title-om">{{ $title }}</h3>

            <form class="inquires-form-om" method="POST">
                @csrf
                    <div class="row-om">
                    <div class="col-om">
                        <div class="group-om">
                            <label class="gr-lable-om" for="name-1">@lang('Your name')</label>
                            <input type="text" name="name" required class="gr-input-om" id="name-1">
                        </div>
                    </div>
                    <div class="col-om">
                        <div class="group-om">
                            <label class="gr-lable-om" for="name-2">@lang('Store name')</label>
                            <input type="text" name="store_name" required class="gr-input-om" id="name-2">
                        </div>
                    </div>
                 
                    <div class="col-om">
                        <div class="group-om">
                            <label class="gr-lable-om" for="phone-om">@lang('Mobile')</label>
                            <div class="group-warp-input-om">
                                <input type="tel" name="mobile" required class="gr-input-om tel-padd-om" id="phone-om">
                                <span class="phone-key-om">+966</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-om">
                        <div class="group-om">
                            <label class="gr-lable-om" for="main-address-om">@lang('Address')</label>
                            <input type="text" name="address" required class="gr-input-om" id="main-address-om">
                        </div>
                    </div>
                    <div class="col-om">
                        <div class="group-om">
                            <label class="gr-lable-om" for="commercial-activities-om">@lang('Commercial activities')</label>
                            <input type="text" name="activity" required class="gr-input-om" id="commercial-activities-om">
                        </div>
                    </div>

                    <div class="col-om">
                        <div class="group-om">
                            <label class="gr-lable-om" for="email-om">@lang('Email')</label>
                            <input type="email" name="email" required class="gr-input-om" id="email-om">
                        </div>
                    </div>

                    <div class="col-om col-sm-12">
                        <div class="group-om">
                            <label class="gr-lable-om" for="email-om">@lang('Request Details')</label>
                            <textarea name="details" class="form-control" rows="6" placeholder="{{ __('Request Details') }}"></textarea>
                        </div>
                    </div>
                  
                    <div class="col-om" style="margin-top:20px">
                        <div class="group-om ">
                            <input class="gr-input-om subbmit-butt-om save-changes-om" type="submit"
                                value="@lang('Send')">
                        </div>
                    </div>
                 
                </div>
            </form>
        </section>


    </div>
</main>
<!-- end main-presonal-page-om -->
@stop