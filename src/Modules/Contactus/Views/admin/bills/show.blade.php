@extends('Common::admin.layout.page')
@section('page')

    <div class="row">
        <div class="col-sm-12">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">@lang('Message Details')</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-stripped">
                        <tbody>
                            <tr>
                                <th>@lang("Created at")</th>
                                <td>{{ $message->created_at }}</td>
                            </tr>
                            <tr>
                                <th>@lang('Client')</th>
                                <td>{{ $message->name }}</td>
                            </tr>
                            <tr>
                                <th>@lang('Phone')</th>
                                <td>{{ $message->mobile }}</td>
                            </tr>
                            {{-- <tr>
                            <th>@lang('Email')</th>
                            <td>{{ $message->email }}</td>
                        </tr> --}}
                            <tr>
                                <th>@lang('Message')</th>
                                <td>{{ $message->message }}</td>
                            </tr>
                            @if ($message->reason_id)
                                <tr>
                                    <th>@lang('Reason')</th>
                                    <td>{{ $message->reason->title->{app()->getLocale()} ?? '#' }}</td>
                                </tr>
                            @endif
                            @if ($info = $message->extra_info)
                                @if ($message->type == 'pre_book')
                                    <tr>
                                        <th>@lang('Real Estate')</th>
                                        <td>{{ $info->code }} - {{ $info->name->{app()->getLocale()} ?? '' }}</td>
                                    </tr>
                                @else
                                    <tr>
                                        <th>@lang('Unit')</th>
                                        <td>{{ $info->code }} - {{ $info->name->{app()->getLocale()} ?? '' }}</td>
                                    </tr>
                                @endif
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </form>
@stop
