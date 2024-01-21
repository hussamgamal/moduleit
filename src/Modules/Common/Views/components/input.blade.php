<div class="form-group">
    <label for="input{{ $name }}">{{ $mytitle }}</label>
    <input {{ $required }} type="{{ $input['type'] ?? 'text' }}" {{ isset($input['disabled']) ? 'readonly' : '' }} name="{{ $name }}" value="{{ !is_object($value) && !is_array($value) ? $value : '' }}" class="form-control"
        placeholder="{{ $mytitle }}" id="input{{ $name }}">
</div>