<?php

namespace MshMsh\Modules\Common\Controllers\Admin\Actions;

trait CheckRoles
{
    public function get_role_name()
    {
        if (!$this->role_name) {
            $singular = ucfirst($this->name);
            $singular_arr = explode('_', $singular);
            $singular = count($singular_arr) > 1 ? $singular_arr[0] . ucfirst($singular_arr[1]) : $singular;
            $this->role_name = $singular;
        }
    }

    public function check_user_roles()
    {
        $this->get_role_name();

        $all_roles = auth()->user()->role->all_roles ?? renter_roles();
        $this->can_delete = $this->can_add = $this->can_edit = false;
        if (isset($all_roles[$this->role_name]) && $role = $all_roles[$this->role_name]) {
            $this->can_delete = $role['delete'] ?? false;
            $this->can_add = $role['add'] ?? false;
            $this->can_edit = $role['edit'] ?? false;
        }
    }
}
