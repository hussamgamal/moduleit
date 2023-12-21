<div class="form-group">
    <label for="exampleInputEmail1">{{ $mytitle }}</label>
    <textarea {{ $required }} name="{{ $name }}" rows="5" class="form-control"
        placeholder="{{ $mytitle }}">{{ $value }}</textarea>
</div>
