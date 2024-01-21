<div class="form-group">
    <label>{{ $mytitle }}</label>
    <input {{ isset($input['disabled']) ? 'readonly' : '' }} {{ $required }} type="number" step="0.1" name="{{ $name }}" value="{{ $value }}" class="form-control"
        placeholder="{{ $mytitle }}">
</div>