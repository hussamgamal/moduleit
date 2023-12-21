@extends('Common::index')
@section('title' , __("Forget Password"))

@section('page')
<!-- start main-sign-in-page-om -->
<main class="main-sign-in-page-om">
    <div class="container">
        <div class="login-om">
            <h2 class="site-title-om">نسيت كلمة المرور</h2>
            @if(session()->has('error'))
                <div class="group-om">
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                </div>
            @endif
            <form class="singin-form-om" action="{{ route('forget_password') }}" method="post">
                @csrf
                <div class="group-om">
                    <label class="gr-lable-om" for="phone-om">رقم الجوال</label>
                    <input required name="mobile" type="tel" class="gr-input-om" id="phone-om">
                </div>
                <div class="group-om ">
                    <input class="gr-input-om subbmit-butt-om" type="submit" value="استعادة كلمة المرور">
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
<!-- end main-sign-in-page-om -->
@stop