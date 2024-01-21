<?php

namespace MshMsh\Modules\Common\Controllers\Admin\Actions;

trait CheckRoles
{
    public function getRoleName()
    {
        if (!$this->roleName) {
            $singular = ucfirst($this->name);
            $singular_arr = explode('_', $singular);
            $singular = count($singular_arr) > 1 ? $singular_arr[0] . ucfirst($singular_arr[1]) : $singular;
            $this->roleName = $singular;
        }
    }

    public function check_user_roles()
    {
        $this->getRoleName();

        $all_roles = auth('admin')->user()->role->all_roles;
        $this->can_delete = $this->can_add = $this->can_edit = false;
        if (isset($all_roles[$this->roleName]) && $role = $all_roles[$this->roleName]) {
            $this->can_delete = $role['delete'] ?? false;
            $this->can_add = $role['add'] ?? false;
            $this->can_edit = $role['edit'] ?? false;
        }
    }
}
