@extends('Common::admin.layout.page')
@section('page')
    <form action="{{ $action }}" method="post" enctype="multipart/form-data" class="action_form" novalidate>
        @foreach (request()->query() as $key => $val)
            <input type="hidden" name="{{ $key }}" value="{{ $val }}">
        @endforeach
        @if ($method == 'put')
            {{ method_field('put') }}
        @endif
        @csrf
        @if (isset($lang_inputs) && count($lang_inputs))
            <div class="row">

                @include('Common::admin.form.lang_inputs')

                @if (count($inputs ?? []))
                    @php $title =  __('Options') @endphp
                    @include('Common::admin.form.inputs')
                @endif

            </div>
        @elseif (isset($group_inputs))
            @include('Common::admin.form.groups')
        @else
            @php $title = __($title).' [ '.($method == 'post' ? __('Add') : __('Edit')).' ]'; @endphp
            @include('Common::admin.form.inputs')
        @endif
        @include('Common::admin.form.includes')
        @include('Common::admin.form.images')
        @include('Common::admin.form.map')


        <div class="card">
            <div class="card-footer">
                <button type="submit" class="btn btn-primary"> <span>{{ __('Save') }}</span>
                    <i class="fas fa-save"></i></button>
            </div>
        </div>
    </form>
    @if (!$model->id)
        <script>
            $(".select2").val('').trigger('change');
        </script>
    @endif
    <script>
        $('.select2').select2({
            allowClear: true,
            placeholder: function() {
                console.log($(this).data('placeholder'));
                $(this).data('placeholder');
            }
        });
    </script>
@stop
