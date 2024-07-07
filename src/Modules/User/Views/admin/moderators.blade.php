@extends('Common::admin.layout.page')
@section('page')
<!-- general form elements -->
<form action="{{ route('admin.moderators') }}" method="post" class="action_form" novalidate>
    @csrf
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-danger">
                <div class="card-header">
                    <h3 class="card-title">@lang('Moderators')</h3>
                </div>
                <div class="card-body">
                    <input type="hidden" name="role_id" value="{{ request('role_id') }}">
                    <div class="form-group">
                        <label>@lang('Select role moderators')</label>
                        <select required name="users[]" class="select2" multiple data-placeholder="@lang(" Moderators")"
                            style="width: 100%;" searchable>
                            @foreach($users as $user)
                            <option {{ in_array($user->id , $role->users) ? 'selected' : '' }} value="{{ $user->id }}">
                                {{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary"> <span>{{ __("Save") }}</span> <i
                                class="fas fa-save"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<script>
    $('.select2').select2();

</script>
@stop
