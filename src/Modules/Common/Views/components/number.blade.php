<div class="form-group">
    <label for="exampleInputEmail1">{{ $input['title'] }}</label>
    <input {{ isset($input['disabled']) ? 'readonly' : '' }} {{ $required }} type="number" step="{{@$input['step'] ?? '0.1'}}" min="0" name="{{ $name }}" value="{{ $value }}" class="form-control"
        placeholder="{{ $input['title'] }}">
</div>
