<div class="form-group">
    <label for="exampleInputEmail1">{{ $mytitle }}</label>
    <input {{ $required }} type="{{ $input['type'] ?? 'text' }}" {{ isset($input['disabled']) ? 'readonly' : '' }} name="{{ $name }}" value="{{ !is_object($value) && !is_array($value) ? $value : '' }}" class="form-control"
        placeholder="{{ $mytitle }}">
</div>