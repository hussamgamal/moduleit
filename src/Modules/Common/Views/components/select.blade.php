<div class="form-group" style="display:{{ isset($input['hidden']) ? 'none' : 'block' }}">
    <label>{{ $input['title'] }}</label>
    <select {{ isset($input['disabled']) ? 'readonly' : '' }} {{ $required }} name="{{ $name }}"
        class="{{ !isset($input['notselect2']) ? 'select2' : '' }} form-control" {{ $input['multiple'] ?? '' }}
        data-placeholder="{{ $input['title'] }}" style="width: 100%;" searchable>
        @foreach ($input['values'] as $key => $val)
            @if (is_array($value))
                <option {{ in_array($key, $value) ? 'selected' : '' }} value="{{ $key }}">
                    {{ __($val) }}</option>
            @else
                <option {{ request($name) == $key || $value == $key ? 'selected' : '' }} value="{{ $key }}">
                    {{ __($val) }}</option>
            @endif
        @endforeach
    </select>
</div>
