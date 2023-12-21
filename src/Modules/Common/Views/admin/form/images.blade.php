@if (isset($has_images))
    <div class="card">
        <div class="card-body">
            <x-input input="input" name="images[]" :model="$model" lang="all" />
        </div>
    </div>
@endif
