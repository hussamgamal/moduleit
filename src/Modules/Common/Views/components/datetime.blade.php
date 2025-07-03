<div class="form-group">
    <label for="exampleInputEmail1">{{ $input['title'] }}</label>
    <input onkeydown="return false" type="datetime-local" {{ $required }} min="{{ $value ? $value : date('Y-m-d H:i') }}"
        name="{{ $name }}" @if(!empty($value) && $value != '') value="{{\Carbon\Carbon::parse($value)->format('Y-m-d H:i')}}" @endif class="form-control" placeholder="{{ $input['title'] }}">
</div>
