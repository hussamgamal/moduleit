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
                <table id="example2" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            {{-- <th>@lang('Name')</th> --}}
                            <th>@lang('Area')</th>
                            {{-- <th>@lang('Block')</th> --}}
                            {{-- <th>@lang('Avenue')</th> --}}
                            <th>@lang('Street')</th>
                            <th>@lang('Building no')</th>
                            <th>@lang('Level no')</th>
                            <th>@lang('Full address')</th>
                            {{-- <th>{{ __("Delete") }}</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rows as $row)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            {{-- <td>{{ $row->address['address_name'] ?? '' }}</td> --}}
                            <td>{{ $row->area->name->{app()->getLocale()} ?? '' }}</td>
                            {{-- <td>{{ $row->address['block'] ?? '' }}</td> --}}
                            {{-- <td>{{ $row->address['avenue'] ?? '' }}</td> --}}
                            <td>{{ $row->address['street'] ?? '' }}</td>
                            <td>{{ $row->address['building_number'] ?? '' }}</td>
                            <td>{{ $row->address['level'] ?? '' }}</td>
                            <td>{{ $row->address['full_address'] ?? '' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>
<script>
    // $('.table').DataTable({
    //     "paging": false,
    //     "lengthChange": false,
    //     "searching": false,
    //     "ordering": true,
    //     "info": false,
    //     "autoWidth": false,
    // });

</script>

@stop
