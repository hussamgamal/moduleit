<!-- bootstrap color picker -->
<link rel="stylesheet" href="{{ url('assets/admin') }}/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.css">
    
<div class="form-group">
    <label>{{ $mytitle }}</label>

    <div class="input-group colorpicker">
        <input style="direction: ltr !important" type="color" {{ $required }} name="{{ $name }}" value="{{ $value }}" class="form-control">

    </div>
    <!-- /.input group -->
</div>
<!-- /.form group -->
<!-- bootstrap color picker -->