<style>
    .select2 {
        width: 100% !important
    }

</style>
<div class="form-group">
    <label style="display: block">{{ $input['title'] }}
    </label>
    <select {{ $required }} name="{{ $name }}" class="form-control not_select2 select2"
        data-title="{{ $input['title'] }}" data-placeholder="{{ $input['title'] }}" {{ $input['multiple'] ?? '' }}>
        @if ($input['values'])
            @foreach ($input['values'] as $id => $val)
                <option selected value="{{ $id }}">{{ $val }}</option>
            @endforeach
        @endif
    </select>
</div>

<script>
    $(document).ready(function() {
        console.log('1111111');
        $("[name='{{ $name }}']").select2({
            placeholder: "Search for an Item",
            minimumInputLength: 2,
            ajax: {
                url: "{{ $input['action'] }}",
                dataType: 'json',
                type: "GET",
                quietMillis: 50,
                data: function(term) {
                    return {
                        term: term
                    };
                },
                processResults: function(data) {
                    console.log(data);
                    return {
                        results: $.map(data, function(obj) {
                            return {
                                id: obj.id,
                                text: obj.name
                            };
                        })
                    };
                }
            }
        });
    });
</script>

@if ($model->$name)
    <script>
        $(document).ready(function() {
            $("[name='{{ $name }}']").trigger('change');
        });
    </script>
@endif
