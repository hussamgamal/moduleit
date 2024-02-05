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
                        @if($message->type == 'request')
                        <tr>
                            <th>@lang('Trip')</th>
                            <td>{{ $message->trip }}</td>
                        </tr>
                        <tr>
                            <th>@lang('Budget')</th>
                            <td>{{ $message->budget }}</td>
                        </tr>
                        @else
                        <tr>
                            <th>@lang('Email')</th>
                            <td>{{ $message->email }}</td>
                        </tr>
                        <tr>
                            <th>@lang('Message')</th>
                            <td>{{ $message->message }}</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</form>
@stop
