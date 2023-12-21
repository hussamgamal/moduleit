<div class="mb-3">
    <label>{{ $mytitle }}</label>
    <textarea class="textarea" name="{{ $name }}" placeholder="{{ $mytitle }}">{{ $value }}</textarea>
</div>
<script>
    $('.textarea').summernote({
        placeholder: "{{ __('Write here') }}",
        height: 300,
    })

</script>
