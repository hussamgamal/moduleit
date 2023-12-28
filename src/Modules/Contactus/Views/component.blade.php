<!-- start of contact us -->
<section class="contact-us wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">
    <div class="container">
        <div class="row">
            <div class="col-md">
                <div class="right">
                    <img src="{{ url(app_setting('contact_us_image')) }}">
                </div>
            </div>
            <div class="col-md">
                <div class="left">
                    <h2 class="title">{{ $title ?? __('Contact us') }} </h2>
                    <div class="parent">
                        <div class="child1">
                            <label>@lang('Mobile')</label>
                            <p>{{ app_setting('mobile') }}</p>
                        </div>
                        <div class="child2">
                            <label>@lang('Email')</label>
                            <p>{{ app_setting('email') }}</p>
                        </div>
                    </div>
                    <form action="{{ route('contactus') }}" method="POST" novalidate>
                        @csrf
                        <input type="hidden" name="type" value="{{ request('type', 'contact') }}">
                        @if ($id = request('aqar_id'))
                            <input type="hidden" name="extra_info[aqar_id]" value="{{ $id }}">
                        @endif
                        @if ($id = request('unit_id'))
                            <input type="hidden" name="extra_info[unit_id]" value="{{ $id }}">
                        @endif
                        <div class="form-group">
                            <input type="text" required placeholder="@lang('Name')" name="name" class="form-control">
                            <img src="{{ url('assets/web') }}/images/user_name.png">
                        </div>
                        <div class="form-group">
                            <input type="text" name="mobile" required placeholder="@lang('Mobile')"
                                class="form-control">
                            <img src="{{ url('assets/web') }}/images/phone (1).png">
                        </div>
                        @if (!request('type'))
                            <div class="form-group">
                                <select name='reason_id' required class="reasonselect" style="width: 100%">
                                    @foreach ($reasons ?? [] as $row)
                                        <option value='{{ $row->id }}'>{{ $row->title }}</option>
                                    @endforeach
                                </select>
                                <img src="{{ url('assets/web') }}/images/reason_for_contact.png">
                            </div>
                        @endif
                        <div class="form-group">
                            <textarea class="form-control" name="message" required placeholder="@lang('Write your message here ...')"
                                rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit">
                                @lang('Send')
                                <i class="fa fa-arrow-left"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end of contact -->
