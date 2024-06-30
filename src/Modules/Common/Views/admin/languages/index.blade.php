@extends('Common::admin.layout.page')
@section('page')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ __($title) }}</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive">
                    <table id="example2" class="table table-bordered table-striped table-hover">
                        <thead>
                        <tr>
                            <th class="visible">{{__('language')}}</th>
                            <th>{{ __('Edit') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{__('Arabic')}}</td>
                                <td>
                                    <a class="btn btn-primary mlink"
                                       href="{{route('admin.translations.editWords','ar')}}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>{{__('English')}}</td>
                                <td>
                                    <a class="btn btn-primary mlink"
                                       href="{{route('admin.translations.editWords','en')}}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>

        $('.table').DataTable({
            dom: 'lfrtip',
            searching: false,
            bInfo: false, //Dont display info e.g. "Showing 1 to 4 of 4 entries"
            paging: false, //Dont want paging
            bPaginate: false, //Dont want paging
        });
    </script>
@endsection
