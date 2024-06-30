<div class="form-group">
    <label for="exampleInputEmail1">{{ $input['title'] }}</label>
    @if(isset($input['values']))
        @foreach($input['values'] as $key => $value)
        <div class="icheck-primary d-inline">
            <input {{ $required }} name="{{ "$name[$key]" }}" type="checkbox" id="checkboxPrimary{{ $name.$key }}">
            <label for="checkboxPrimary{{ $name.$key }}">
                {{ $value }}
            </label>
        </div>
        @endforeach
    @else
    <div class="icheck-primary d-inline">
        <input name="{{ $name }}" type="checkbox" id="checkboxPrimary{{ $name }}">
        <label for="checkboxPrimary{{ $name }}">
            {{ $input['title'] }}
        </label>
    </div>
    @endif
</div>
