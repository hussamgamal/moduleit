@php
    $admin_actions = ['list' , 'add' , 'edit' , 'delete'];    
@endphp
<a href="#!" class="select_all">تحديد الكل</a>
@foreach(admin_roles() as $role)
    <div class="row">
        <label class="col-sm-12">
            {{ __($role) }}
        </label>
        <div class="col-sm-12 col-md-6" style="display: flex;flex-direction:row;justify-content: space-between;">
            @foreach($admin_actions as $action)
                <div>
                    <input {{ isset($model->all_roles[$role]) && isset($model->all_roles[$role][$action]) ? 'checked' : '' }} id="all_roles{{$role.$action}}" type="checkbox" class="rolescheck" name="all_roles[{{$role}}][{{$action}}]" value="1">
                    <label style="color: #999" for="all_roles{{$role.$action}}">{{ __($action) }}</label>
                </div>
            @endforeach
        </div>
    </div>
    <hr>
@endforeach
<script>
    $('.select_all').click(function(){
        $('.rolescheck').attr('checked' , 'checked');
        return false;
    });
</script>