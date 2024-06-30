<div class="form-group">
    <label for="exampleInputEmail1">{{ $input['title'] }}</label>
    <textarea {{ $required }} name="{{ $name }}" rows="5" class="form-control"
        placeholder="{{ $input['title'] }}">{{ $lang != 'all' ? (method_exists($model,'getTranslation') ? $model->getTranslation(str_replace("[$lang]",null,$name),$lang) : $value) : $value }}</textarea>
</div>
