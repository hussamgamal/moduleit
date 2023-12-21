<!-- general form elements -->
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $title }}
        </h3>
    </div>
    <div class="card-body">
        <div class="row">
            @foreach ($inputs as $myname => $input)
                <div
                    class="{{ count($inputs) <= 2 || (isset($input['type']) && in_array($input['type'], ['editor', 'textarea'])) ? 'col-sm-12' : 'col-sm-3' }}">
                    <x-input :input="$input" :name="$myname" :model="$model" lang="all" />
                </div>
            @endforeach
        </div>
    </div>
</div>
<!-- /.card -->
