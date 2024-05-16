<div class="modal fade deal_modal_report alert_modal" id="booking_done_modal" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal_block__">
                <figure class="figure__ icon__ loading-omd">
                    {{-- <img class="lazy-omd img-om" data-src="{{ url('assets/web') }}/images/shapes/payment_page_icon.svg"
                        alt=".." /> --}}
                </figure>
                {{-- <h2 class="title">@lang('A visit appointment has been successfully booked')</h2> --}}
                <p class="sub_title__">
                    {{ session('success', session('error')) }}
                </p>
                @if ($redirect = session('redirect'))
                    <a href="{{ $redirect['link'] }}" class="submit-button__ full_width__">
                        {{ $redirect['title'] }}
                    </a>
                @endif

                <button type="button" class="close_modal_button" data-dismiss="modal" aria-label="Close">
                    <img class="close_modal_img" src="{{ url('assets/web') }}/images/shapes/close_modal_button.svg"
                        alt="" />
                </button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.alert_modal').modal('show');
    });
</script>
