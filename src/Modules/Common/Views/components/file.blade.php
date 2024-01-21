<div class="form-group">
    <label>{{ $mytitle }}</label>
    <input {{ $required }} type="{{ $input['type'] ?? 'text' }}" name="{{ $name }}" value="{{ $value }}" class="form-control"
        placeholder="{{ $mytitle }}">
</div>