@extends('Common::admin.layout.page')
@section('page')
    <!-- general form elements -->
    <form action="{{ route('admin.notifications') }}" method="post" class="action_form" novalidate>
        @csrf
        <div class="row">
            <div class="col-sm-12 col-md-8">
                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">@lang('Send notification')</h3>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-tabs langs">
                            @foreach (config('app.locales') as $myname => $lang)
                                <li class="{{ $loop->iteration == 1 ? 'active' : '' }}">
                                    <a data-toggle="tab" href="#{{ $myname }}"
                                       class="{{ $loop->iteration == 1 ? 'active' : '' }}">
                                        <span>{{ __($lang) }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>

                        <div class="tab-content">
                            @foreach (config('app.locales') as $lang_name => $lang)
                                <div id="{{ $lang_name }}"
                                     class="tab-pane fade {{ $loop->iteration == 1 ? 'in active show' : '' }}">
                                    <div class="form-group">
                                        <label class="col-sm-12" for="">عنوان الاشعار</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" name="title[{{ $lang_name }}]">
                                        </div>
                                    </div>
                                    <input name="user_id" value="{{ auth('admin')->id() }}" hidden>
                                    <div class="form-group">
                                        <label class="col-sm-12" for="">@lang('Notice text')</label>
                                        <div class="col-sm-12">
                                            <textarea required name="content[{{ $lang_name }}]" class="form-control" rows="5" placeholder="نص الاشعار"></textarea>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary"> <span>{{ __('Send') }}</span> <i
                                    class="fas fa-save"></i></button>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-sm-12 col-md-4">
                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">@lang('settings')</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <label for="">@lang('send to')</label>
                                <select name="for" class="form-control selectpicker" title="@lang('send to')" id="">
                                    <option value="all">@lang('For everyone')</option>
                                    <option value="{{\App\Enum\UserType::CLIENT}}"> {{__('clients')}}</option>
                                    <option value="{{\App\Enum\UserType::DELEGATE}}"> {{__('delegates')}}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">@lang('Notifications')</h3>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered">
                <thead>
                <th>#</th>
                <th>{{__('Title')}}</th>
                <th>{{__('Text')}}</th>
                <th>{{__('By')}}</th>
                <th>{{__('Created at')}}</th>
                <th>{{__('Delete')}}</th>
                </thead>
                <tbody>
                @if(count($notifications) > 0)
                    @foreach ($notifications as $row)
                        <tr>
                            <td>
                                {{ $loop->iteration }}
                            </td>
                            <td>{{ data_get($row,'title.ar') }}</td>
                            <td>{{ data_get($row,'content.ar') }}</td>
                            <td>{{$row->user?->name }}</td>
                            <td>{{ $row->created_at }}</td>
                            <td>
                                <form action="{{ route('admin.notifications.destroy', $row->id) }}" method="post"
                                      class="action_form remove">
                                    @csrf
                                    {{ method_field('delete') }}
                                    <button type="submit" class="btn btn-danger removethis">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" class="text-center">{{__('there is no data yet')}}</td>
                    </tr>
                @endif
                </tbody>
            </table>
            <div class="center w-25 p-3">
                {{ $notifications->links() }}
            </div>

        </div>
    </div>
    <!-- /.card -->
@endsection
