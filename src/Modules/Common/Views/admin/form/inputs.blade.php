@php $input_col = count($inputs) <= 2 || (isset($input['type']) && in_array($input['type'], ['editor', 'textarea'])) || count($lang_inputs ?? []) ? 'col-sm-12' : 'col-sm-3'; @endphp
<div class="{{ count($lang_inputs ?? []) ? 'col-md-4' : 'col-md-12' }}">
    <!-- general form elements -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $title }}
            </h3>
        </div>
        <div class="card-body">
            <div class="row">
                @foreach ($inputs ?? [] as $myname => $input)
                    <div class="{{ $input_col }}">
                        <x-input :input="$input" :name="$myname" :model="$model" lang="all" />
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- /.card -->
</div>
