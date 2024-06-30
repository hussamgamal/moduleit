@php $input_col = count($inputs ?? []) <= 2 || (isset($input['type']) && in_array($input['type'], ['editor', 'textarea'])) || count($langInputs ?? []) ? 'col-sm-12' : 'col-sm-6'; @endphp
<div class="{{ count($langInputs ?? []) ? 'col-md-4' : 'col-md-12' }}">
    <!-- general form elements -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $group_title ?? $title }}
            </h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="{{ isset($extra_inputs) ? 'col-sm-7' : 'col-sm-12' }}">
                    @foreach ($inputs as $myname => $input)
                        <x-input :input="$input" :name="$myname" :model="$model" lang="all" />
                    @endforeach
                </div>
                @if (isset($extra_inputs))
                    <div class="col-sm-5">
                        @foreach ($extra_inputs as $myname => $input)
                            <x-input :input="$input" :name="$myname" :model="$model" lang="all" />
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
    <!-- /.card -->
</div>
