@extends('User::index')

@section('userpage')
<section class="mypersonal-f-data-sec-om personal-card-om">
    <h3 class="sub-data-title-om">@lang('Change Password')</h3>
    @if(session()->has('success'))
        <div class="alert alert-succes">
            {{ session('success') }}
        </div>
    @else
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <form class="mydata-form" action="{{ route('change_password') }}">
        <div class="row-om">
            <div class="col-om">
                <div class="group-om">
                    <label class="gr-lable-om" for="password-om">@lang('Current Password')</label>
                    <input type="password" name="old_password" class="gr-input-om pass-add-om" id="password-om">  
                    @if(isset($errors) && $errors->has('old_password'))
                        <span class="error">{{ $errors->get('old_password')[0]  ?? '' }}</span>
                    @endif
                </div>
            </div>
            <div class="col-om">
                <div class="group-om">
                    <label class="gr-lable-om" for="new-password-om">@lang('New Password')</label>
                    <div class="group-warp-input-om">
                        <input type="password" name="password" class="gr-input-om pass-add-om" id="new-password-om">
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
            <div class="col-om">
                <div class="group-om ">
                    <input class="gr-input-om subbmit-butt-om pass-save-changes-om" type="submit" value="@lang('Save')">
                </div>
            </div>
           
        </div>
    </form>
</section>
@stop