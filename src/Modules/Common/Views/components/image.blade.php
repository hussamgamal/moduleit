@php $image = is_string($value) ? url($value) : ""; @endphp
<div class="form-group">
    <label for="input{{ $name }}">{{ $mytitle }}</label>
    @if ($image)
        <a href="{{ $image }}" target="_blank" style="font-size:13px">عرض المرفق</a>
    @endif
    <div class="input-group">
        <div class="mycustom-file">
            <input {{ $required }} name="{{ $name }}" type="file" class="mycustom-file-input"
                id="input{{ $name }}">
            <label title="@lang('Choose image')" class="mycustom-file-label">
                <div class="image">
                    <i class="fas fa-image"></i>
                    <span>@lang('Choose image')</span>
                    <img onerror="this.style.display='none'" src="{{ $image }}">
                </div>
            </label>
        </div>
    </div>
</div>
