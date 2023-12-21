<?php

namespace Modules\User\Controllers\Admin;

use Modules\Common\Controllers\Admin\HelperController;
use Modules\User\Models\Role;
use Modules\User\Models\User;

class RolesController extends HelperController
{
    public function __construct()
    {
        $this->model = new Role;
        $this->title = "Roles";
        $this->name =  'roles';
        $this->list = ['name' => 'الاسم'];
        
        $types = [
            '0' => 'صلاحية فرعية',
            '1' => 'تحكم كامل'
        ];

        $this->inputs = [
            'is_main' => ['title' => 'نوع الصلاحية', 'type' => 'select', 'values' => $types],
            'name' => ['title' =>  'اسم الصلاحية '],
            'roles[]' =>  ['title' => 'الصلاحيات', 'type' => 'select', 'values' => admin_roles(), 'multiple' => 'multiple']
        ];

        $this->includes[] = 'User::admin.roles';

    }

    public function destroy($id)
    {
        $this->model->findOrFail($id)->delete();
        User::where('role_id', $id)->update(['role_id' => null]);
        return response()->json(['url' => route('admin.' . $this->name . '.index'), 'message' => __("Deleted successfully")]);
    }

    public function moderators()
    {
        if (!request('role_id')) abort(404);
        if (request()->isMethod('get')) {
            $users = User::where('role_id', request('role_id'))->orWhere('role_id', null)->get();
            $role = Role::find(request('role_id'));
            $title = "Moderators";
            return view('User::admin.moderators', get_defined_vars());
        }
        // dd(request('users'));
        $users = User::whereIn('id', request('users'))->update(['role_id' => request('role_id')]);
        return response()->json(['url' => route('admin.roles.index'), 'message' => __("Info saved successfully")]);
    }
}
