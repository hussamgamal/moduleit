@extends('Common::admin.layout.page')
@section('page')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ __($title) }}</h3>
                    @if ($canAdd)
                        <a href="{{ route("admin.$name.create", request()->query()) }}" class="mlink btn btn-success"><i
                                class="fa fa-plus"></i>
                            <span>{{ __('Add new') }}</span></a>
                    @endif
                    @if(count($speed_links) > 0)
                        <ul class="d-flex list-unstyled">
                        @foreach($speed_links as $link)
                            <li class="mx-1">
                                <a href="{{route($link['link'],@$link['query'])}}" class="mlink btn btn-primary"><i class="{{@$link['icon']}}"></i> {{@$link['title']}} ({{(int) @$link['count']}})</a>
                            </li>
                        @endforeach
                        </ul>
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
                                        {{ $col_title }}</th>
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
                                @if ($canEdit)
                                    <th>{{ __('Edit') }}</th>
                                @endif
                                @if ($canShow)
                                    <th>{{ __('Show') }}</th>
                                @endif

                                @if ($canDelete)
                                    <th>{{ __('Delete') }}</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rows as $row)
                                <tr id="{{$row->id}}">
                                    <td class="visible">{{ $loop->iteration }} @if(isset($routeSortList))<i class="fa fa-sort"></i>  @endif</td>
                                    @foreach ($list as $key => $col_title)
                                        @php
                                            $value = $row->$key;
                                        @endphp
                                        @if ($key != 'created_at' && !in_array($key , $row->getFillable()) && method_exists($row, explode('_', $key)[0]))
                                            <td class="visible">
                                                {{ $row->getValOfKey($row, $key) }}
                                            </td>
                                        @elseif(in_array($key, ['image', 'path']))
                                            <td class="visible"><img style="width: 200px;" src="{{ $value }}" /></td>
                                        @elseif(in_array($key, ['color']))
                                            <td class="visible"><span style="width: 50px;height: 30px;display: block;margin:0 auto;background: {{$value}}"></span></td>
                                        @else
                                            <td class="visible">{!! $value !!}</td>
                                        @endif
                                    @endforeach

                                    @if (isset($links))
                                        @foreach ($links as $link)
                                            <td>
                                                <a class="btn btn-{{ $link['type'] }} mlink"
                                                    href="{{ $link['url'] . '?' . $link['key'] . '=' . $row->id . '&' . http_build_query($requestQueries) }}">
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
                                    @if ($canEdit)
                                        <td>

                                            <a class="btn btn-primary mlink"
                                                href="{{ route("admin.$name.edit", array_merge([$row->id], request()->query())) }}">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </td>
                                    @endif
                                    @if ($canShow)
                                        <td>

                                            <a class="btn btn-warning mlink"
                                                href="{{ route("admin.$name.show", array_merge([$row->id], request()->query())) }}">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        </td>
                                    @endif
                                    @if ($canDelete)
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
        @if(isset($routeSortList))
        $(function (){
            'use strict'
            $( ".table tbody" ).sortable({
                items: "tr",
                cursor: 'move',
                opacity: 0.6,
                update: function() {
                    sendSortToServer();
                }
            });

            function sendSortToServer() {
                var sort = [];
                $('.table tbody tr').each(function(index,element) {
                    sort.push({
                        id: $(this).attr('id'),
                        sort: index+1
                    });
                });

                $.ajax({
                    type: "get",
                    dataType: "json",
                    url: "{{$routeSortList}}",
                    data: {
                        sort: sort,
                    },
                    success: function(response) {
                    }
                });
            }
        });
        @endif
        $('.table').DataTable({
            dom: 'Blfrtip',
            searching: true,
            bInfo: true, //Dont display info e.g. "Showing 1 to 4 of 4 entries"
            paging: false, //Dont want paging
            bPaginate: true, //Dont want paging
            stateSave: true,
            lengthMenu: [
                [10, 25, 50, 100],
                [10, 25, 50, 100]
            ],
            buttons: [{
                    extend: 'copyHtml5',
                    text: "<i class='fas fa-copy'></i> {{ __('Copy') }}",
                    className:'btn btn-info',
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
                    className:'btn btn-primary',
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
                    className:'btn btn-success',
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
