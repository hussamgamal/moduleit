@extends('User::index')

@section('userpage')

<section class="notification-sec-om personal-card-om">
    <h3 class="sub-data-title-om">@lang('Notifications')</h3>
    <ul class="notifcation-list-om list-unstyled">
        @forelse($rows as $row)
        <li class="li-om">
            <a class="link-om" href="{{ $row->link }}">{{ $row->text }}</a>
        </li>
        @empty
        <div class="col-sm-12">
            <h3 class="col-sm-12" style="text-align:center; margin-bottom:50px">@lang('You do not have any notifications yet')</h3>
        </div>
        @endforelse
    </ul>
</section>
@stop