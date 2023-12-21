@extends('Common::index')
@section('title' , __("Activate Your Account"))

@section('page')
<style>
    .active_codes{
        direction: ltr;
        margin: 10px 0px;
    }
    .active_codes input{
        width: 23%;
        margin:1%;
    }
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
    }

    /* Firefox */
    input[type=number] {
    -moz-appearance: textfield;
    }
</style>
<!-- start main-sign-in-page-om -->
<main class="main-sign-up-page-om">
    <div class="container">
        <div class="login-om signup-om">
            <h2 class="site-title-om">@lang('Activate Your Account')</h2>
            <form class="singup-form-om" action="" method="post">
                @csrf
                <input type="hidden" name="mobile" value="{{ $mobile }}">
                <div class="alert alert-success">
                    {{ $message }}
                </div>
                <div class="first-row-om">
                    <div class="col-om" style="margin: auto;float: none;">
                        <div class="group-om">
                            <label class="gr-lable-om" for="name-1">@lang('Activation Code')</label>
                            <div class="row active_codes">
                                <input data-count="1" type="number" class="gr-input-om" id="name-1" name="code[]" required>
                                <input data-count="2" type="number" class="gr-input-om" id="name-1" name="code[]" required>
                                <input data-count="3" type="number" class="gr-input-om" id="name-1" name="code[]" required>
                                <input data-count="4" type="number" class="gr-input-om" id="name-1" name="code[]" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="group-om ">
                    <input class="gr-input-om subbmit-butt-om" type="submit" value="@lang('Activate Your Account')">
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
@section('scripts')
<script>
    $('.active_codes input').keyup(function(){
        if($(this).val() > 9){
            $(this).val(9);
        }
        var count = $(this).data('count') + 1; 
        $('.active_codes input:nth-child('+count+')').focus();
    });
</script>
@stop