@extends('Common::admin.layout.page')

@section('page')
    <div class="row">
        <div class="col-sm-12">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">
                        {{ __($title) }}
                    </h3>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        @if($notifications->isNotEmpty())
                            @foreach($notifications as $notify)
                                <li class="position-relative card p-3">
                                    <a href="{{$notify->data['link']}}" class="mlink">
                                        <small>{{@$notify->data['title'][app()->getLocale()]}}</small>
                                        <p class="mb-0">{{@$notify->data['message'][app()->getLocale()]}}</p>
                                        <span style="position: absolute;bottom: 30px;left: 30px;">{{\Carbon\Carbon::parse($notify->created_at)->diffforhumans()}}</span>
                                    </a>
                                </li>
                            @endforeach
                            {{$notifications->links()}}
                        @else
                            <h3 class="text-center">
                                {{__('There is no Notification Yet')}}
                            </h3>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
</div>
@stop
