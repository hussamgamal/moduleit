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
                
                @include("Modules::common.admin.form.lang_inputs")

                @php $title =  __('Options') @endphp
                @include('Modules::common.admin.form.inputs')

            </div>
        @elseif (isset($group_inputs))
            @include('Modules::Common.admin.form.groups')
        @else
            @php $title = __($title).' [ '.$method == 'post' ? __('Add') : __('Edit').' ]'; @endphp
            @include('Modules::common.admin.form.inputs')
        @endif
        @include('Modules::common.admin.form.includes')
        @include('Modules::common.admin.form.images')
        @include('Modules::common.admin.form.map')


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
