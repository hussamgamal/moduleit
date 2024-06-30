<div class="form-group">
    <label for="exampleInputFile">الصور</label>
    <div class="input-group">
        <div class="multi_images">
            @if($model->images)
            @foreach($model->images as $image)
            <div class="imgTag">
                <a id="{{ $image->id }}" class="remove_img"><b>-</b></a>
                <img src="{{ $image->image ?? $image->path }}" alt="">
            </div>
            @endforeach
            @endif
            <div class="mycustom-file">
                <input multiple name="images[]" type="file" class="mycustom-file-input" accept="image/*" multiple>
                <label title="اختر صور" class="mycustom-file-label">
                    <div class="image">
                        <i class="fas fa-image"></i>
                        <span>اختر صور</span>
                    </div>
                </label>
            </div>
        </div>
    </div>
</div>
<script>
    $('.remove_img').click(function () {
        var btn = $(this);
        var t = confirm("هل تريد الحذف ؟");
        if(t){
            var model = "{{ str_replace('\\' , '/' , get_class($model)) }}";
            $.get("{{route('remove_img')}}", {
                id: btn.attr('id'),
                model: model
            });
            btn.closest('.imgTag').remove();
        }
    });

</script>
