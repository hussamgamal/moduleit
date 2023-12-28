@extends('Common::admin.layout.page')
@section('page')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ __($title) }}</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('Client')</th>
                                {{-- <th>@lang('Email')</th> --}}
                                <th>@lang('Phone')</th>
                                @if (request('type') == 'report')
                                    <th>@lang('Aqar')</th>
                                @endif
                                <th>@lang('Sent at')</th>
                                <th>@lang('Show')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($messages as $row)
                                <tr style="background:{{ $row->seen ? '' : '#f5cabe' }}">
                                    <td>{{ $row->id }}</td>
                                    <td>{{ $row->name ?? ($row->user->name ?? '#') }}</td>
                                    {{-- <td>{{ $row->email }}</td> --}}
                                    <td>{{ $row->mobile ?? ($row->user->mobile ?? '') }} </td>
                                    @if (request('type') == 'report')
                                        <td>{{ $row->aqar->title->{app()->getLocale()} ?? '' }}</td>
                                    @endif
                                    <th>{{ $row->created_at }}</th>
                                    <td class="actions_td">
                                        <a class="btn btn-primary mlink"
                                            href="{{ route('admin.contactus.show', $row->id) }}">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <ul class="paginator">
                        {{ $messages->links() }}
                    </ul>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
@stop
