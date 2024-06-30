<div class="form-group" style="display:{{ isset($input['hidden']) ? 'none' : 'block' }}">
    <label>{{ $input['title'] }}</label>
    <select {{ isset($input['disabled']) ? 'readonly' : '' }} data-placeholder="{{ $input['title'] }}" class="form-control" name="{{ $name }}" {{ $required }}>
        @if($input['values'] && count($input['values']) > 0)
            @foreach($input['values'] as $key => $val)
                @if($input['relation_name'] && isset($val[$input['relation_name']]) && count($val[$input['relation_name']]) > 0)
                    <optgroup label="{{$val->name}}">
                        @foreach($val[$input['relation_name']] as $sub)
                            <option value="{{$sub->id}}" {{ $value == $sub->id ? 'selected' : '' }}>{{$sub->name}}</option>
                        @endforeach
                    </optgroup>
                @endif
            @endforeach
        @endif
    </select>
</div>
