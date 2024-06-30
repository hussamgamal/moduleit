<?php

namespace Modules\Common\Controllers\Admin\Actions;

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
//        $this->canDelete = $this->canAdd = $this->canEdit = false;
        if (isset($all_roles[$this->roleName]) && $role = $all_roles[$this->roleName]) {
            $this->canDelete = $this->canDelete ?? $role['delete'];
            $this->canAdd = $this->canAdd ?? $role['add'];
            $this->canEdit = $this->canEdit ?? $role['edit'];
        }
    }
}
