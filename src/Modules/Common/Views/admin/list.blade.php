@extends('Common::admin.layout.page')
@section('page')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ __($title) }}</h3>
                    <?php
                    if (auth()->user()->type == 'owner') {
                        $can_add = $can_edit = $can_delete = true;
                    }
                    ?>
                    @if ($can_add)
                        <a href="{{ route("admin.$name.create", request()->query()) }}" class="mlink btn btn-success"><i
                                class="fa fa-plus"></i>
                            <span>{{ __('Add new') }}</span></a>
                    @endif
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive">
                    <table id="example2" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="visible">#</th>
                                @foreach ($list as $key => $col_title)
                                    <th class="visible">
                                        {{ app()->getLocale() == 'ar' ? $col_title : ucfirst($key) }}</th>
                                @endforeach
                                @if (isset($links))
                                    @foreach ($links as $link)
                                        <th>{{ __($link['title']) }}</th>
                                    @endforeach
                                @endif
                                @if (isset($switches))
                                    @foreach ($switches as $stitle => $route)
                                        <th>{{ __($stitle) }}</th>
                                    @endforeach
                                @endif
                                @if ($can_edit)
                                    <th>{{ __('Edit') }}</th>
                                @endif
                                @if ($can_show)
                                    <th>{{ __('Show') }}</th>
                                @endif

                                @if ($can_delete)
                                    <th>{{ __('Delete') }}</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rows as $row)
                                <tr>
                                    <td class="visible">{{ $loop->iteration }}</td>
                                    @foreach ($list as $key => $col_title)
                                        @php
                                            $value = $key != 'created_at' && is_object($row->$key) ? $row->$key->{app()->getLocale()} : $row->$key;
                                        @endphp
                                        @if ($key != 'created_at' && method_exists($row, explode('_', $key)[0]))
                                            <td class="visible">
                                                {{ $row->getValOfKey($row, $key) }}
                                            </td>
                                        @elseif(in_array($key, ['image', 'path']))
                                            <td class="visible"><img src="{{ $value }}" /></td>
                                        @else
                                            <td class="visible">{!! __($value) !!}</td>
                                        @endif
                                    @endforeach

                                    @if (isset($links))
                                        @foreach ($links as $link)
                                            <td>
                                                <a class="btn btn-{{ $link['type'] }} mlink"
                                                    href="{{ $link['url'] . '?' . $link['key'] . '=' . $row->id . '&' . http_build_query(request()->query()) }}">
                                                    <i class="fa {{ $link['icon'] }}"></i>
                                                </a>
                                            </td>
                                        @endforeach
                                    @endif
                                    @if (isset($switches))
                                        @foreach ($switches as $stitle => $route)
                                            <td>
                                                <label class="switch">
                                                    <input type="checkbox" {{ $row->$stitle > 0 ? 'checked' : '' }}
                                                        class="change_status" value="{{ $row->id }}"
                                                        data-route="{{ $route }}">
                                                    <span class="slider round"></span>
                                                </label>
                                            </td>
                                        @endforeach
                                    @endif
                                    @if ($can_edit)
                                        <td>

                                            <a class="btn btn-primary mlink"
                                                href="{{ route("admin.$name.edit", array_merge([$row->id], request()->query())) }}">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </td>
                                    @endif
                                    @if ($can_show)
                                        <td>

                                            <a class="btn btn-warning mlink"
                                                href="{{ route("admin.$name.show", array_merge([$row->id], request()->query())) }}">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        </td>
                                    @endif
                                    @if ($can_delete)
                                        <td>
                                            <form action="{{ route("admin.$name.destroy", $row->id) }}" method="post"
                                                class="action_form remove">
                                                @csrf
                                                {{ method_field('delete') }}
                                                <button type="submit" class="btn btn-danger removethis">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if ($paginate)
                        <ul class="paginator">
                            {{ $rows->appends(request()->query())->links() }}
                        </ul>
                    @endif
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>


    <script>
        $('.table').DataTable({
            dom: 'Bfrtip',
            searching: false,
            bInfo: false, //Dont display info e.g. "Showing 1 to 4 of 4 entries"
            paging: false, //Dont want paging
            bPaginate: false, //Dont want paging
            buttons: [{
                    extend: 'copyHtml5',
                    text: "<i class='fas fa-copy'></i> {{ __('Copy') }}",
                    exportOptions: {
                        columns: ['.visible'],
                        modifier: {
                            page: 'all',
                            search: 'none'
                        }
                    },
                },
                {
                    extend: 'excelHtml5',
                    text: "<i class='fas fa-file-excel'></i> {{ __('Export to excel') }}",
                    exportOptions: {
                        columns: ['.visible'],
                        modifier: {
                            page: 'all',
                            search: 'none'
                        }
                    },
                },
                {
                    extend: 'print',
                    text: "<i class='fas fa-print'></i> {{ __('Print') }}",
                    exportOptions: {
                        columns: ['.visible'],
                        modifier: {
                            page: 'all',
                            search: 'none'
                        }
                    },
                },
            ]
        });
    </script>

@stop
