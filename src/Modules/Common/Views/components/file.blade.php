<div class="form-group">
    <label for="exampleInputEmail1">{{ $input['title'] }}</label>
    <input {{ $required }} type="{{ $input['type'] ?? 'text' }}" name="{{ $name }}" value="{{ $value }}" class="form-control"
        placeholder="{{ $input['title'] }}">
</div>
