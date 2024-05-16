<div class="{{ count($inputs ?? []) ? 'col-sm-8' : 'col-sm-12' }}">
    <!-- general form elements -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ __($title) }} [<span
                    class="action_type">{{ $method == 'post' ? __('Add') : __('Edit') }}</span>]</h3>
        </div>
        <div class="card-body">

            <ul class="nav nav-tabs langs">
                @foreach (config('app.locales') as $myname => $lang)
                    <li class="{{ $loop->iteration == 1 ? 'active' : '' }}">
                        <a data-toggle="tab" href="#{{ $myname }}"
                            class="{{ $loop->iteration == 1 ? 'active' : '' }}">
                            {{-- <img src="{{ url("locale/$myname.png") }}" /> --}}
                            <span>{{ __($lang) }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>

            <div class="tab-content">
                @foreach (config('app.locales') as $lang_name => $lang)
                    <div id="{{ $lang_name }}"
                        class="tab-pane fade {{ $loop->iteration == 1 ? 'in active show' : '' }}">
                        <div class="row">
                            @foreach ($langInputs as $myname => $input)
                                <div class="{{ count($inputs ?? []) || count($langInputs ?? []) <= 2 ? 'col-sm-12' : 'col-sm-6' }}">
                                    <x-input :input="$input" :name="$myname" :model="$model" :lang="$lang_name" />
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
        <!-- /.card-body -->

    </div>
    <!-- /.card -->
</div>
