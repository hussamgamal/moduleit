<div class="form-group" style="display:{{ isset($input['hidden']) ? 'none' : 'block' }}">
    <label>{{ $mytitle }}</label>
    <select {{ isset($input['disabled']) ? 'readonly' : '' }} {{ $required }} name="{{ $name }}"
        class="{{ !isset($input['notselect2']) ? 'select2' : '' }} form-control" {{ $input['multiple'] ?? '' }}
        data-placeholder="{{ $mytitle }}" style="width: 100%;" searchable>
        @foreach ($input['values'] as $key => $val)
            @if (is_array($value))
                <option {{ in_array($key, $value) ? 'selected' : '' }} value="{{ $key }}">
                    {{ __($val) }}</option>
            @else
                <option {{ $value == $key || request($name) == $key ? 'selected' : '' }}
                    value="{{ $key }}">{{ __($val) }}</option>
            @endif
        @endforeach
    </select>
</div>
