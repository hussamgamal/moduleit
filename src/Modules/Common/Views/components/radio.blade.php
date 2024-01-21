<div class="form-group clearfix">
    <label>{{ $mytitle }}</label>
    @foreach($input['values'] as $key => $value)
    <div class="icheck-primary d-inline">
        <input {{ $required }} type="radio" id="radioPrimary{{ $key }}" name="{{ $name }}">
        <label for="radioPrimary{{ $key }}">
            {{ $value }}
        </label>
    </div>
    @endforeach
</div>
