<?php

namespace App\Modules\User\Controllers;

use App\Http\Controllers\Admin\AdminController;
use App\Modules\RBAC\Models\Permission;
use App\Modules\RBAC\Models\Role;
use Illuminate\Http\Request;
use Gate;
use User;

class PermissionController extends AdminController
{
    public function index()
    {
        if (!auth()->user()->can('CHANGE_PERMISSIONS')) {
            return back()->with(['error' => 'У вас нет прав для редактирование привилегии']);
        }

        $roles = Role::all();
        $perms = Permission::all();

        $this->view('user::perm.index');

        return $this->render(compact('roles', 'perms'));
    }

    public function store(Request $request)
    {
        return User::savePermissions($request);
    }
}
