<div class="mb-3">
    <label>{{ $input['title'] }}</label>
    <textarea class="textarea" name="{{ $name }}" placeholder="{{ $input['title'] }}">{{ $value }}</textarea>
</div>
<script>
    $('.textarea').summernote({
        placeholder: "{{ __('Write here') }}",
        height: 300,
    })

</script>
