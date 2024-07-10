
<a href="#!" class="select_all">تحديد الكل</a>
<div class="sidebar-detached sidebar-left">
    <div class="row">
        <?php
        $role = \Spatie\Permission\Models\Role::findById(request()->route('role'))->load('permissions');
        $permissionLists = $role->permissions->pluck('name')->toArray();
        ?>
        @foreach(\MshMsh\Helpers\PermissionsList::list('admin') as $group=>$permissions)
            <div class="col col-md-4 col-sm-6 md-3 roll-checkk">
                <div class="card">
                    <div class="card-body">
                        <div class="brands">

                            <a class="filter-title mb-0 select-all-permissions">{{__($group)}}</a>
                            <div class="brand-list" id="brands">
                                <ul class="list-unstyled">
                                    <li class="d-flex justify-content-between align-items-center py-25">
                                        <span class="vs-checkbox-con vs-checkbox-primary">
                                            <input class="checkbox-input check-all"
                                                   {{--name="permissions[]"--}} type="checkbox"
                                                   data-parsley-multiple="permissions">
                                            <span class="vs-checkbox">
                                                <span class="vs-checkbox--check">
                                                    <i class="fas fa-check text-white"></i>
                                                </span>
                                            </span>
                                            <span class="">{{__('check all')}}</span>
                                        </span>
                                    </li>
                                    @foreach(json_decode(json_encode($permissions),true) as $permission)
                                        <li class="d-flex justify-content-between align-items-center py-25">
                                             <span class="vs-checkbox-con vs-checkbox-primary">
                                                <input name="permissions[]" value="{{$permission['route']}}"
                                                       class="checkbox-input checkk rolescheck"
                                                       type="checkbox"
                                                       @if(in_array($permission['route'],$permissionLists)) checked @endif
                                                       data-parsley-multiple="permissions">
                                                <span class="vs-checkbox">
                                                    <span class="vs-checkbox--check">
                                                        <i class="fas fa-check text-white"></i>
                                                    </span>
                                                </span>
                                                <span
                                                    class=""> {{$permission['title']}}</span>
                                            </span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @endforeach
    </div>
</div>
<script>
    $('.select_all').click(function(){
        $('.rolescheck').attr('checked' , 'checked');
        return false;
    });
    $(".check-all").on("change", function () {
        if ($(this).is(':checked'))
            $(this).parents(".roll-checkk").find(".checkk").attr("checked", true);
        else
            $(this).parents(".roll-checkk").find(".checkk").attr("checked", false);
    })
</script>
