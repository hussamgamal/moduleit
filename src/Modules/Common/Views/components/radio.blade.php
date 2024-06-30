<div class="form-group clearfix">
    <label class="d-block" for="exampleInputEmail1">{{ $input['title'] }}</label>
    @foreach($input['values'] as $key => $value)
    <div class="icheck-primary d-inline">
        <input {{ $required }} type="radio" id="radioPrimary{{ $key }}" @if($input['value'] == $key) checked @endif value="{{$key}}" name="{{ $name }}">
        <label for="radioPrimary{{ $key }}">
            {{ $value }}
        </label>
    </div>
    @endforeach
</div>
