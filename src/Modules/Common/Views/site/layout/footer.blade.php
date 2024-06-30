<footer class="footer_sec__">
    <div class="container">
        <div class="footer_content__">
            <figure class="footer_logo figure__ center">
                <img class="img-om" src="{{ app_setting('footer_logo') }}" alt="{{ app_setting('title') }}" />
            </figure>
            <ul class="footer_list__ list-unstyled">
                @foreach (pages() as $row)
                    <li><a href="{{ $row->link }}">{{ $row->title }}</a></li>
                @endforeach
                <li><a href="{{ route('contactus') }}">@lang('Contact us')</a></li>
            </ul>
            <ul class="footer_socials__ list-unstyled">
                @foreach (socials() as $row)
                    <li class="li__">
                        <a href="{{ $row->value }}" target="__blank" class="link__">
                            <img class="img-om" src="{{ url('assets/web') }}/images/socials/{{ $row->key }}.svg"
                                alt="{{ $row->key }}" width="" height="" />
                        </a>
                    </li>
                @endforeach
            </ul>
            <div class="copyrights_content___">
                <img class="copyright_icon__" src="{{ url('assets/web') }}/images/shapes/copyright.png"
                    alt="{{ app_setting('title') }}" />

                @lang('All right reserved to')
                <a href="#!">
                    <img class="copyright_logo__" src="{{ url('assets/web') }}/images/shapes/copyrights.svg"
                        alt="{{ app_setting('title') }}" />
                </a>
            </div>
        </div>
    </div>
</footer>
