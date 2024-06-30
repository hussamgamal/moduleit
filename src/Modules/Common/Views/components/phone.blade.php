<!-- phone mask -->
<div class="form-group">
    <label>{{ $input['title'] }}</label>

    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-phone"></i></span>
        </div>
        <input dir="ltr" style="direction:ltr !important" {{ $required }} style="text-align:left" type="text" class="form-control" name="{{ $name }}" value="{{ $value }}"
            data-inputmask="'mask': ['999-999-9999 [x99999]', '+099 99 99 9999[9]-9999']" data-mask>
    </div>
    <!-- /.input group -->
</div>
<!-- /.form group -->
<script>
    $('[data-mask]').inputmask();
</script>
