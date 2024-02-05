<div class="form-group">
    <label for="exampleInputEmail1">{{ $mytitle }}</label>
    <input {{ $required }} type="{{ $input['type'] ?? 'text' }}" name="{{ $name }}" value="{{ $value }}" class="form-control"
        placeholder="{{ $mytitle }}">
</div>