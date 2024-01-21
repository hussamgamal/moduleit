@extends('Common::index')
@section('title', __('Activate Your Account'))

@section('page')
    <main class="registeration_page__ verification_page__ default_page__" id="verification_page__">
        <div class="container">
            <div class="default_form__ small_padding">
                <div class="form_title__ centered">
                    <h1 class="registeration_title center__">@lang('Confirmation Code')</h1>
                    <p class="parg__ verification_parag__">
                        @lang('Type the 6-digit verification code that was sent to you via your mobile number')
                    </p>
                    <p class="number_parag__">{{ $mobile }}</p>
                </div>
                <form method="POST" @if($route = request('route')) action="{{ $route }}" @endif>
                    @csrf
                    <div class="input_group__">
                        <div class="input-group-om code_shapes__">
                            <input placeholder="0" name="code[]" class="code-input" required />
                            <input placeholder="0" name="code[]" class="code-input" required />
                            <input placeholder="0" name="code[]" class="code-input" required />
                            <input placeholder="0" name="code[]" class="code-input" required />
                            <input placeholder="0" name="code[]" class="code-input" required />
                            <input placeholder="0" name="code[]" class="code-input" required />
                        </div>
                    </div>
                    <div class="final_buttons_wrapper__">
                        <button class="submit-button__ verification_submit_button full_width__">
                            @lang('Verify')
                        </button>
                    </div>
                    <div class="verification_timer_wrapper__">
                        <span class="timer__ countdown" timerValueInSeconds="120"></span>
                        <div class="timer_progress_wrapper">
                            <span class="progress__"></span>
                        </div>

                        {{-- <h4 class="title__">@lang('Verification code not sent?')</h4>
                        <button disabled id="send_code_again_button__"
                            class="submit-button__ sign_up_link__ send_code_again_button__">
                            @lang('Send code again')
                        </button> --}}
                    </div>
                </form>
            </div>
        </div>
    </main>
@stop
