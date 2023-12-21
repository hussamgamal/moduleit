@extends('Common::index')
@section('title' , __("Register"))

@section('page')
<!-- start main-sign-in-page-om -->
<main class="main-sign-up-page-om">
    <div class="container">
        <div class="login-om signup-om">
            <h2 class="site-title-om">@lang('Register')</h2>
            <form class="singup-form-om" action="" method="post">
                @csrf
                <div class="first-row-om">
                    <div class="col-om">
                        <div class="group-om">
                            <label class="gr-lable-om" for="name-1">@lang('First Name')</label>
                            <input type="text" class="gr-input-om" id="name-1" name="first_name" required>
                        </div>
                        @if($errors->has('first_name'))
                            <span class="merror"><b>{{ $errors->get('first_name')[0] }}</b></span>
                        @endif
                    </div>
                    <div class="col-om">
                        <div class="group-om">
                            <label class="gr-lable-om" for="name-2">@lang('Second Name')</label>
                            <input type="text" class="gr-input-om" id="name-2" name="second_name" required>
                        </div>
                        @if($errors->has('second_name'))
                            <span class="merror"><b>{{ $errors->get('second_name')[0] }}</b></span>
                        @endif
                    </div>
                    <div class="col-om">
                        <div class="group-om">
                            <label class="gr-lable-om" for="name-3">@lang('Third Name')</label>
                            <input type="text" class="gr-input-om" id="name-3" name="third_name" required>
                        </div>
                        @if($errors->has('third_name'))
                            <span class="merror"><b>{{ $errors->get('third_name')[0] }}</b></span>
                        @endif
                    </div>
                </div>

                <div class="second-row-om">
                    <div class="col-om">
                        <div class="group-om">
                            <label class="gr-lable-om" for="phone-om">@lang('Mobile')</label>
                            <div class="group-warp-input-om">
                                <input type="tel" placeholder="5xxxxxxxx" class="gr-input-om tel-padd-om" id="phone-om" name="mobile" required>
                                <span class="phone-key-om">+966</span>
                            </div>
                        </div>
                        @if($errors->has('mobile'))
                            <span class="merror"><b>{{ $errors->get('mobile')[0] }}</b></span>
                        @endif
                    </div>
                    <div class="col-om">
                        <div class="group-om">
                            <label class="gr-lable-om" for="email-om">@lang('Email')</label>
                            <input type="email" class="gr-input-om" id="email-om" name="email" required>
                        </div>
                    </div>
                    @if($errors->has('email'))
                            <span class="merror"><b>{{ $errors->get('email')[0] }}</b></span>
                        @endif
                </div>
                <div class="second-row-om">
                    <div class="col-om">
                        <div class="group-om">
                            <label class="gr-lable-om" for="city-om">@lang('Area')</label>

                            <select class="selectpicker selct-options-om" id="" name="area_id">
                                @foreach($areas as $row)
                                <option value="{{ $row->id }}">{{ $row->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-om">
                        <div class="group-om">
                            <label class="gr-lable-om" for="password-om">@lang('Password')</label>
                            <div class="group-warp-input-om">
                                <input type="password" name="password" class="gr-input-om pass-add-om" id="password-om">
                                <div class="show-password-togg-om">
                                    <figure class="figure-om">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="23.335" height="15"
                                            viewBox="0 0 23.335 15">
                                            <g transform="translate(-2.252 -7.875)">
                                                <path class="path-om"
                                                    d="M13.907,7.875c-4.188,0-7.49,2.635-11.438,6.943a.823.823,0,0,0-.005,1.109c3.38,3.734,6.359,6.948,11.443,6.948,5.021,0,8.786-4.047,11.464-6.979a.817.817,0,0,0,.026-1.078C22.667,11.51,18.891,7.875,13.907,7.875Zm.229,12.182A4.687,4.687,0,1,1,18.6,15.594,4.689,4.689,0,0,1,14.136,20.057Z"
                                                    transform="translate(0 0)" fill="#ffc000" />
                                                <path class="path-om"
                                                    d="M16.834,14.385a2.447,2.447,0,0,1,.161-.88c-.052,0-.1-.005-.161-.005a3.333,3.333,0,1,0,3.333,3.333c0-.068-.005-.135-.005-.2a2.31,2.31,0,0,1-.948.2A2.418,2.418,0,0,1,16.834,14.385Z"
                                                    transform="translate(-2.917 -1.458)" fill="#ffc000" />
                                            </g>
                                        </svg>
                                    </figure>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="group-om ">
                    <input required type="checkbox" id="conditionCheck">
                    <label for="conditionCheck">
                        <span> @lang('I Accept')</span>
                        <a target="_blank" href="{{ url('pages/policy') }}"> @lang('terms & condition')</a>
                </label>
                </div>
                <br>
                <div class="group-om ">
                    <input class="gr-input-om subbmit-butt-om" type="submit" value="@lang('Register')">
                </div>
            </form>
            <div class="image-of-form-om">
                <figure class="figure-om loading-omd">
                    <img class="lazy-omd" data-src="{{ url('assets/web') }}/images/form.svg" alt="..">
                </figure>
            </div>
        </div>
    </div>
</main>
@stop