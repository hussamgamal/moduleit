<div class="form-group">
    <label for="exampleInputEmail1">{{ $input['title'] }}</label>
    <input {{ $required }} type="{{ $input['type'] ?? 'text' }}" {{ isset($input['disabled']) ? 'readonly' : '' }} name="{{ $name }}" value="{{ $lang != 'all' ? (method_exists($model,'getTranslation') ? $model->getTranslation(str_replace("[$lang]",null,$name),$lang) : $value) : $value }}" class="form-control"
        placeholder="{{ $input['title'] }}">
</div>
