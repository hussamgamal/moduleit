<?php

namespace Modules\User\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Route;
use Modules\Common\Controllers\Admin\HelperController;
use Modules\User\Models\Admin;
use MshMsh\Helpers\PermissionsList;
use Spatie\Permission\Models\Role;

class RolesController extends HelperController
{
    public function __construct()
    {
        $this->model = new Role();
        $this->rows = $this->model->where('name','!=','Super Admin');
        $this->title = "Roles";
        $this->name =  'roles';
        $this->list = ['name' => 'الاسم'];


        $this->inputs = [
            'name' => ['title' =>  'اسم الصلاحية '],
        ];

        $this->includes[] = 'User::admin.roles';
    }

    public function store(Request $request)
    {
        $data = $this->formRequest ? app($this->formRequest)->validated() : $request->all();
        $data['guard_name'] = 'admin';
        PermissionsList::storePermissions($request['permissions']);
        $model = $this->model->create($data);
        $model->syncPermissions($request['permissions']);
        return $this->successfullResponse();
    }
    public function update(Request $request, $id)
    {
        $data = $this->formRequest ? app($this->formRequest)->validated() : $request->all();
        $this->model = $this->model->findOrFail($id);
        PermissionsList::storePermissions($request['permissions']);
        $this->model->update($data);
        $this->model->syncPermissions($request['permissions']);
        \Artisan::call('optimize:clear');
        \Artisan::call('cache:forget spatie.permission.cache ');
        return $this->successfullResponse();
    }
    public function destroy($id)
    {
        $model = $this->model->findOrFail($id);
        if($model->users()->count() > 0) {
            return $this->failedfullResponse();
        }
        $model->delete();
        return response()->json(['url' => route('admin.' . $this->name . '.index'), 'message' => __("Deleted successfully")]);
    }
    public function moderators()
    {
        if (!request('role_id')) abort(404);
        if (request()->isMethod('get')) {
            $users = Admin::all();
            $role = Role::find(request('role_id'));
            $title = "Moderators";
            return view('User::admin.moderators', get_defined_vars());
        }
        return response()->json(['url' => route('admin.roles.index'), 'message' => __("Info saved successfully")]);
    }
}
